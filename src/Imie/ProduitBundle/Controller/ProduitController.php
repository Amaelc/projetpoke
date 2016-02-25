<?php

namespace Imie\ProduitBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ProduitController extends Controller
{
    
    public function indexAction() //
    {
        return $this->render('ImieProduitBundle:Produit:index.html.twig');
    }
    
    public function voirAction($id)
    {
    return $this->render('ImieProduitBundle:Produit:voir.html.twig', array('id' => $id));
    }
}
