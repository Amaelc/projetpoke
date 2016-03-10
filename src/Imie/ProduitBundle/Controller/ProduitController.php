<?php

namespace Imie\ProduitBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Imie\ProduitBundle\Entity\Produit;
use Imie\ProduitBundle\Form\ProduitType;

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
        if($pos>0){
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
        foreach($this->tabProduits as $key=>$produit){
            if ($produit->getId()==$id){
                $pos=$key;
                break;
            }
        }
        return  $pos;
    }

    private function createCreateForm(Produit $entity)
    {
        $form = $this->createForm(new ProduitType(), $entity, array(
            'action' => $this->generateUrl('imie_produit_ajouter'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Ajouter'));

        return $form;
    }
    
    public function ajouterAction(){
        
        $entity = new Produit();
        $form   = $this->createCreateForm($entity);
        
        $request = $this->getRequest();
        
        if ($request->getMethod() == 'POST') {
            $form->handleRequest($request);

            if($form->isValid()){
                $em = $this->getDoctrine()->getManager();
                $em->persist($entity);
                $entity->getIdimage()->upload(); // Nouvelle méthode pour uploader
                $em->persist($entity->getIdimage());
                
                $em->flush();
                return $this->redirect($this->generateUrl('imie_produit_list'));

            }
        }

        return $this->render('ImieProduitBundle:Produit:ajouter.html.twig',
                array('form' => $form->createView()));
    }
    
    public function modifierAction($id)
    {
        // initialisations
        $variables = array();
        $variables['id'] =$id;        
        
        $entityManager = $this->getDoctrine()->getManager();  
        // récupérer le produit en paramètre 
        $repoProduit = $entityManager->getRepository('ImieProduitBundle:Produit'); 
        
        $produit = $repoProduit->find($id);
        
        $form = $this->createForm(new ProduitType(), $produit, array('action' => $this->generateUrl('imie_produit_modifier',array('id' => $id) )));

        $form->add('submit', 'submit', array('label' => 'Modifier'));
        
        $request = $this->getRequest();
        
        if ($request->getMethod() == 'POST') {
            $form->handleRequest($request);

            if($form->isValid()){
        
        $produit->getIdimage()->upload(); // Nouvelle méthode pour uploader
        $entityManager->persist($produit->getIdimage());
        $entityManager->flush();
            }
        }
        
        $variables['produit'] = $produit;        
        
        //récupérer les stocks de ce produit
        $repoStock = $entityManager->getRepository('ImieProduitBundle:Stock'); 
        $stocksProduit = $repoStock->findByProduit($id);   
        $variables['stocksProduit'] = $stocksProduit; 
        
        $variables['produitprecedent'] = $this->prec( $id);
        $variables['produitsuivant'] = $this->next($id);
        
        $variables['form'] = $form->createView();
        
        return $this->render('ImieProduitBundle:Produit:modifier.html.twig', $variables);
    }
    
    public function supprimerAction($id) {
        
        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository('ImieProduitBundle:Produit');
        // On récupère le stock grâce à l'id passé en paramètre
        $produit = $repo->find($id);
        if (!$produit) {
        throw $this->createNotFoundException('Pas de produit n°'.$id);
        }
        // On supprime le produit
        $em->remove ($produit);
        $em->flush ();
        // Redirection vers la liste des produits
        return $this->redirect($this->generateUrl('imie_produit_list'));
    }
    
}
