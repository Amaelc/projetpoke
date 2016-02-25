<?php

namespace Imie\ProduitBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Imie\ProduitBundle\Entity\Produit;
use Imie\ProduitBundle\Entity\Stock;
use Imie\ProduitBundle\Repository\ProduitRepository;
use Imie\ProduitBundle\Repository\StockRepository;



class DefaultController extends Controller
{
    public function indexAction()
    {

        //
        return $this->render('ImieProduitBundle:Default:index.html.twig');
    }
}
