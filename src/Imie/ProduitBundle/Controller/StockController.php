<?php

namespace Imie\ProduitBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Imie\ProduitBundle\Entity\Produit;
use Imie\ProduitBundle\Entity\Stock;
use Imie\ProduitBundle\Repository\ProduitRepository;
use Imie\ProduitBundle\Repository\StockRepository;
use Imie\ProduitBundle\Form\StockType;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route; 
use Symfony\Component\HttpFoundation\Session\Session;

class StockController extends Controller
{  
    protected $pos = 0;
    protected $tabStocks = array();
    
    public function indexAction(Request $request) {

        $categories = $request->get('categorie'); 
        $couleurs = $request->get('couleur'); 
        $tailles = $request->get('taille');
        $regrouper = $request->get('regrouper');
          
        $parametres['categories']=$categories;
        $parametres['couleurs']=$couleurs;
        $parametres['tailles']=$tailles;
        $parametres['regrouper']=$regrouper;
         
        $entityManager = $this->getDoctrine()->getManager();  
        
        // On récupère le stock 
        $repo = $entityManager->getRepository('ImieProduitBundle:Stock');
        $stocks = $repo->getStocks($entityManager, $parametres);   // gérer les cas ou on veut les stocks pour une ou plusieurs cétagoires, couleurs tailles
        $variables['stocks'] = $stocks;
        
        //$variables['tabstocks'] = array_values($stock);

        // On récupère la liste des categories
        $variables['categories'] = $entityManager
                                    ->getRepository('ImieProduitBundle:Categorie')
                                    ->findAll();
        
        // On récupère la liste des tailles
        $variables['tailles'] = $entityManager
                                    ->getRepository('ImieProduitBundle:Taille')
                                    ->findAll();
        
        // On récupère la liste des couleurs
        $variables['couleurs'] = $entityManager
                                    ->getRepository('ImieProduitBundle:Couleur')
                                    ->findAll();
        
        $variables['pcategories']   = $categories;
        $variables['pcouleurs']     = $couleurs;
        $variables['ptailles']      = $tailles;
        $variables['pregrouper']    = $regrouper;
        
        //stockage en session
        $session = $request->getSession();
        $session->set('variables', $variables);
        //$this->tabStocks =$stocks;
        
        if(!isset($regrouper) || empty($regrouper)){
            unset($this->tabStocks);
            $p=0;
            foreach($stocks as $stock){
                    $this->tabStocks[$p] =$stock;     //  [$stock->getId()]
                    $p++;
            }
        }
        
        return $this->render('ImieProduitBundle:Stock:index.html.twig', $variables); 
    }
    
    
  
    /** 
     * @Route("/paginate", name="user_paginate")
     * // pour datatables en ajax  
     */ 
    public function paginateAction(Request $request) 
    { 
        //echo "<br/>paginateAction";
        $length = $request->get('length'); 
        $length = $length && ($length!=-1)?$length:0; 
 
        $start = $request->get('start'); 
        $start = $length?($start && ($start!=-1)?$start:0)/$length:0; 
 
        $search = $request->get('search'); 
        $filters = [ 
            'query' => @$search['value'] 
        ]; 
 
        $datas = $this->getDoctrine()->getRepository('ImieProduitBundle:Stock')->search( 
            $filters, $start, $length 
        ); 
         
        $output = array( 
            'data' => array(), 
            'recordsFiltered' => count($this->getDoctrine()->getRepository('ImieProduitBundle:Stock')->search($filters, 0, false)), 
            'recordsTotal' => count($this->getDoctrine()->getRepository('ImieProduitBundle:Stock')->search(array(), 0, false)) 
        ); 
        
        foreach ($datas as $data) { 
            $output['data'][] = [ 
                'qtestock'                     => $data->getQtestock(),
                'qtedefectueux'                => $data->getQtedefectueux(),
                'dateachat'                    => $data->getDateachat(),
                'id'                           => $data->getId(),
                'idutilisateur'                => $data->getIdUtilisateur(),
                'idfournisseur'                => $data->getIdFournisseur(),
                'idtaille'                     => $data->getIdTaille(),
                    'taille'                   => (is_object($data->getIdTaille()))? $data->getIdTaille()->getTaille():''."",
                'idcouleur'                    => $data->getIdcouleur(),
                   'couleur'                   => (is_object($data->getIdcouleur()))? $data->getIdcouleur()->getCouleur():''."",
                'idproduit'                    => $data->getIdproduit(),
                
                         'nom'                 => $data->getIdproduit()->getNom()."",
                         'description'         => substr($data->getIdproduit()->getDescription(),0,80)."...",
                         'prix'                => $data->getIdproduit()->getPrix(),
                         'idcategorie'         => $data->getIdproduit()->getIdcategorie(),
                               'categorie'     => $data->getIdproduit()->getIdcategorie()->getNom()."",
                         'idimage'             => $data->getIdproduit()->getIdimage(),
                           'nomImage'          => $data->getIdproduit()->getIdimage()->getNom()."",
                           'alt'               => $data->getIdproduit()->getIdimage()->getAlt()."",
                           'url'               => $data->getIdproduit()->getIdimage()->getUrl()."",
                
                'lienmaj'                      => $data->getId(),           
  
            ];    
        } 
 
        return new Response(json_encode($output), 200, ['Content-Type' => 'application/json']); 
    }
    
    
    public function voirAction($id)
    {
        // initialisations
        $variables = array();
        $variables['id'] =$id;
        
        $entityManager = $this->getDoctrine()->getManager();  
        // récupérer le paramètre 
        $repo = $entityManager->getRepository('ImieProduitBundle:Stock');
        $stock = $repo->getStockId($entityManager,$id);  
        $variables['stock'] = $stock; 
        
        // On récupère la liste des categories
        $variables['categories'] = $entityManager
                                    ->getRepository('ImieProduitBundle:Categorie')
                                    ->findAll();
        
        // On récupère la liste des tailles
        $variables['tailles'] = $entityManager
                                    ->getRepository('ImieProduitBundle:Taille')
                                    ->findAll();
        
        // On récupère la liste des couleurs
        $variables['couleurs'] = $entityManager
                                    ->getRepository('ImieProduitBundle:Couleur')
                                    ->findAll();

        $variables['stockprecedent'] = $this->prec( $id);
        $variables['stocksuivant'] = $this->next($id);
        
        //return $this->render('ImieProduitBundle:Produit:voir.html.twig', array('id' => $id));
        return $this->render('ImieProduitBundle:Stock:voir.html.twig', $variables);
    }
    
    public function modifierAction($id)
    {
        // initialisations
        $variables = array();
        $variables['id'] =$id;

        $entityManager = $this->getDoctrine()->getManager();  
        // récupérer le paramètre 
        $repo = $entityManager->getRepository('ImieProduitBundle:Stock');
        $stock = $repo->getStockId($entityManager,$id);  
        $variables['stock'] = $stock; 
        
        // On récupère la liste des categories
        $variables['categories'] = $entityManager
                                    ->getRepository('ImieProduitBundle:Categorie')
                                    ->findAll();
        
        // On récupère la liste des tailles
        $variables['tailles'] = $entityManager
                                    ->getRepository('ImieProduitBundle:Taille')
                                    ->findAll();
        
        // On récupère la liste des couleurs
        $variables['couleurs'] = $entityManager
                                    ->getRepository('ImieProduitBundle:Couleur')
                                    ->findAll();
        
        $variables['stockprecedent'] = $this->prec( $id);
        $variables['stocksuivant'] = $this->next($id);
        
        //return $this->render('ImieProduitBundle:Produit:voir.html.twig', array('id' => $id));
        return $this->render('ImieProduitBundle:Stock:modifier.html.twig', $variables);
    }
    
    public function next($id)
    {
        $pos=$this->getpos($id);
        //echo "<br/>\$pos= $pos  / \$id=$id  !";
        
        if($pos<count($this->tabStocks)-1){
            $pos=$pos+1;
            
        }else{
            $pos= 0;  
        }
        return $this->tabStocks[$pos]->getId();        //$pos;
    }
    
    public function prec( $id)
    {
        $pos=$this->getpos($id);
        if($pos>0){
            $pos=  $pos-1;
        }else{
            $pos= count($this->tabStocks)-1;  
        }   
        return $this->tabStocks[$pos]->getId();        // $pos;
    }
    
    //retourne la position du stock dansla tableau
    public function getPos($id)
    {
        if (empty($this->tabStocks)){
            $this->indexAction($this->getRequest());
        }
        $pos=0;
        foreach($this->tabStocks as $key => $stock){
            if ($stock->getId()==$id){
                $pos=$key;
                //echo "<br/>trouvé stock N° $key = ".$stock->getId()."";
                break;
            }
        }
        return $pos;
    }
    
    public function ajoutAction(){
        $stock = new Stock();
        //$formBuilder = $this->createFormBuilder($stock);
        $form = $this->createForm(new StockType(), $stock, array('action' => $this->generateUrl('imie_stock_ajouter')));
        /*
        $formBuilder
        ->add('qtestock', 'text')
        ->add('qtedefectueux', 'text')
        ->add('Ajouter', 'submit')
        ->setAction($this->generateUrl('imie_stock_ajout'));
        $form = $formBuilder->getForm();
         */
        
        return $this->render('ImieProduitBundle:Stock:ajouter.html.twig',
        array('form' => $form->createView()));
    }
}    