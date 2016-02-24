<?php

namespace Imie\ProduitBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Imie\ProduitBundle\Entity\Produit;
use Imie\ProduitBundle\Entity\Stock;
use Imie\ProduitBundle\Repository\ProduitRepository;
use Imie\ProduitBundle\Repository\StockRepository;

class StockController extends Controller
{
    public function indexAction(){
        $entityManager = $this->getDoctrine()->getManager();  
        $repo = $entityManager->getRepository('ImieProduitBundle:Stock');
        
        $stocks = $repo->getStocks($entityManager);   // gérer les cas ou on veut les stocks pour une ou plusieurs cétagoires, couleurs tailles
        
        $variables['stocks'] = $stocks;

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
}    