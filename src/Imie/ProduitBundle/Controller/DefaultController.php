<?php

namespace Imie\ProduitBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('ImieProduitBundle:Default:index.html.twig');
    }
}
