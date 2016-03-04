<?php

namespace Imie\ProduitBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Imie\ProduitBundle\Entity\Produit;
use Imie\ProduitBundle\Entity\Stock;
use Imie\ProduitBundle\Repository\ProduitRepository;
use Imie\ProduitBundle\Repository\StockRepository;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route; 

class StockController extends Controller
{  
    //public function indexAction(){
    public function indexAction(Request $request) {
        //var_dump($request);
        //$post = $request->request->get('form');
        //echo $post['categorie'];      //si formulaire sans entity
         $post = array();
         // var_dump($request->request->get); 
        /*
         ["request"]=> object(Symfony\Component\HttpFoundation\ParameterBag)#9 (1) { 
            ["parameters":protected]=> array(1) { 
                ["categorie"]=> array(2) { 
                    [0]=> string(1) "1" 
                    [1]=> string(1) "2" } } } 
         ["query"]=> object(Symfony\Component\HttpFoundation\ParameterBag)#10 (1) { 
         ["parameters":protected]=> array(0) { } }        
         */
        $entityManager = $this->getDoctrine()->getManager();  
        
        // On récupère le stock 
        $repo = $entityManager->getRepository('ImieProduitBundle:Stock');
        $stocks = $repo->getStocks($entityManager);   // gérer les cas ou on veut les stocks pour une ou plusieurs cétagoires, couleurs tailles
        $variables['stocks'] = $stocks; //

        // On récupère le nb en stock 
        // $variables['total_stock'] = $entityManager->getRepository(":Stock")->countAll();

        // On récupère la liste des produits
        /* $variables['produits'] = $entityManager
                                    ->getRepository('ImieProduitBundle:Produit')
                                    ->fetchAllWithProduit();*/

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
        
        $variables['post'] = $post;

        return $this->render('ImieProduitBundle:Stock:index.html.twig', $variables); 
    }
    
    
 
    /** 
     * // pour datatable via route imie_stock_paginate
     */ 
    /** 
     * @Route("/paginate", name="user_paginate") 
     */ 
    public function paginateAction(Request $request) 
    { 
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
        
        
        /*
         exemple Stock {#503 ▼
            -qtestock: 40
            -qtedefectueux: 1
            -dateachat: DateTime {#502 ▶}
            -id: 6
            -idutilisateur: Utilisateur {#504 ▶}
            -idfournisseur: Fournisseur {#505 ▶}
            -idtaille: Taille {#506 ▼
              +__isInitialized__: true
              -taille: "38"
              -id: 7
               …2
            }
            -idcouleur: Couleur {#485 ▼
              +__isInitialized__: true
              -couleur: "noir"
              -id: 2
               …2
            }
            -idproduit: Produit {#507 ▼
              -nom: "Legging noir effet jeans imprimé motif fille manga"
              -description: """
                Superbe leggings très tendance pour un effet jeans des plus surprenant. Imitation ceinture à la taille, effet délavé et imprimé avec un motif fille manga sur la cuisse. Leggings très confortable et léger par sa matière douce et extensible.\r\n
                Couleur en différents tons de noir.\r\n
                Modèle : Manga.\r\n
                Composition : Coton, spandex\r\n
                Taille unique S/L (36-40) ? 
                """
              -prix: "29.00"
              -id: 7
              -idcategorie: Categorie {#508 ▶}
              -idimage: Image {#509 ▼
                -nom: "Legging.png"
                -alt: null
                -url: null
                -id: 3
              }
              -listeStock: null
            }
          }
         */
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
}    