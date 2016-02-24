<?php

namespace Imie\ProduitBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Couleur
 */
class Couleur
{
    /**
     * @var string
     */
    private $couleur;

    /**
     * @var integer
     */
    private $id;


    /**
     * Set couleur
     *
     * @param string $couleur
     * @return Couleur
     */
    public function setCouleur($couleur)
    {
        $this->couleur = $couleur;

        return $this;
    }

    /**
     * Get couleur
     *
     * @return string 
     */
    public function getCouleur()
    {
        return $this->couleur;
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }
}
