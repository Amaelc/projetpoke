<?php

namespace Imie\ProduitBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ProduitController extends Controller
{
    
    public function indexAction() //
    {
        $entityManager = $this->getDoctrine()->getManager();  
        $repo = $entityManager->getRepository('ImieProduitBundle:Produit');
        
        $produits = $repo->getProduits($entityManager);   // gérer les cas ou on veut les stocks pour une ou plusieurs cétagoires, couleurs tailles
        
        $variables = array();
        $variables['produits'] = $produits; //


        return $this->render('ImieProduitBundle:Produit:index.html.twig', $variables);
        
        
    }
    
    
    
    public function voirAction($id)
    {
        // initialisations
        $variables = array();
        $variables['id'] =$id;
        
        $entityManager = $this->getDoctrine()->getManager();  
        // récupérer le produit en paramètre 
        $repo = $entityManager->getRepository('ImieProduitBundle:Produit'); 
        $produit = $repo->getProduitId($entityManager, $id);   
        $variables['produit'] = $produit; 
        
        //récupérer les stocks de ce produit
        $repo = $entityManager->getRepository('ImieProduitBundle:Stock'); 
        $stocksProduit = $repo->findByProduit($id);   
        $variables['stocksProduit'] = $stocksProduit; 
        
        //return $this->render('ImieProduitBundle:Produit:voir.html.twig', array('id' => $id));
        return $this->render('ImieProduitBundle:Produit:voir.html.twig', $variables);
    }
}
