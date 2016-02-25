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
    public function indexAction(){
        $entityManager = $this->getDoctrine()->getManager();  
        $repo = $entityManager->getRepository('ImieProduitBundle:Stock');
        
        $stocks = $repo->getStocks($entityManager);   // gérer les cas ou on veut les stocks pour une ou plusieurs cétagoires, couleurs tailles
        
        $variables['stocks'] = $stocks; //

        // On récupère le stock 
        // $variables['total_stock'] = $entityManager->getRepository(":Stock")->countAll();

        // On récupère la liste des produits
        /*$variables['produits'] = $entityManager
                                    ->getRepository('ImieProduitBundle:Produit')
                                    ->fetchAllWithProduit();*/

        // On récupère la liste des categories
        /*$variables['categories'] = $entityManager
                                    ->getRepository('ImieProduitBundle:Categorie')
                                    ->fetchAllWithCategorie();*/
        
        //print_r($variables['produits']);
        
        return $this->render('ImieProduitBundle:Stock:index.html.twig', $variables);
        
    }
    
    
 
    /** 
     * // pour datatable
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
 
        //$users = $this->getDoctrine()->getRepository('AcmeDemoBundle:User')->search(   
        $stocks =  $this->getDoctrine()->getRepository('ImieProduitBundle:Stock')->search( 
            $filters, $start, $length 
        );

        $output = array( 
            'data' => array(), 
            'recordsFiltered' => count($this->getDoctrine()->getRepository('ImieProduitBundle:Stock')->search($filters, 0, false)), 
            'recordsTotal' => count($this->getDoctrine()->getRepository('ImieProduitBundle:Stock')->search(array(), 0, false)) 
        ); 
 
        foreach ($stocks as $stock) { 
            $output['data'][] = [ 
                'id' => $stock->getId(), 
                'nom' => $user->getName()
            ]; 
        } 
 
        return new Response(json_encode($output), 200, ['Content-Type' => 'application/json']); 
    } 
}    