<?php

namespace Imie\ProduitBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ProduitController extends Controller
{
    protected $pos = 0;
    protected $tabProduits = array();
    
    public function indexAction() //
    {
        $entityManager = $this->getDoctrine()->getManager();  
        $repo = $entityManager->getRepository('ImieProduitBundle:Produit');
        
        $produits = $repo->getProduits($entityManager);   // gérer les cas ou on veut les stocks pour une ou plusieurs cétagoires, couleurs tailles
        
        $variables = array();
        $variables['produits'] = $produits; //

            unset($this->tabProduits);
            $p=0;
            foreach($produits as $produit){
                    $this->tabProduits[$p]=$produit;
                    $p++;
            }

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
        
        $variables['produitprecedent'] = $this->prec( $id);
        $variables['produitsuivant'] = $this->next($id);
        
        //return $this->render('ImieProduitBundle:Produit:voir.html.twig', array('id' => $id));
        return $this->render('ImieProduitBundle:Produit:voir.html.twig', $variables);
    }
    
    public function modifierAction($id)
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
        
        $variables['produitprecedent'] = $this->prec( $id);
        $variables['produitsuivant'] = $this->next($id);
        
        //return $this->render('ImieProduitBundle:Produit:voir.html.twig', array('id' => $id));
        return $this->render('ImieProduitBundle:Produit:modifier.html.twig', $variables);
    }
    
    public function next($id)
    {
        $pos=$this->getpos($id);
        //echo "<br/>\$pos= $pos  / \$id=$id  !";
        if($pos<count($this->tabProduits)-1){
            $pos=$pos+1;
            
        }else{
            $pos= 0;  
        }
        //return $this->tabProduits[$pos]->getId();
        return $this->tabProduits[$pos]->getId();        // $pos;
    }
    
    public function prec( $id)
    {
        $pos=$this->getpos($id);
        if($pos>1){
            $pos=  $pos-1;
        }else{
            $pos= count($this->tabProduits)-1;  
        }  
        //return $this->tabProduits[$pos]->getId();
        return $this->tabProduits[$pos]->getId();        // $pos;
    }
    
    //retourne la position du Produits dans le tableau
    public function getPos($id)
    {
        $pos = 0;
        if (empty($this->tabProduits)){
            $this->indexAction($this->getRequest());
        }
        /*if ($pos=array_search($id, array_keys(array_values($this->tabProduits)))){
            $this->pos=$pos;
            return $pos;
        }else{
            return null;
        }*/
        foreach($this->tabProduits as $key=>$produit){
            if ($produit->getId()==$id){
                $pos=$key;
                break;
            }
        }
        return  $pos;
    }
}
