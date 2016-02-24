<?php

namespace Imie\ProduitBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Utilisateur
 */
class Utilisateur
{
    /**
     * @var string
     */
    private $nom;

    /**
     * @var string
     */
    private $pwd;

    /**
     * @var integer
     */
    private $id;


    /**
     * Set nom
     *
     * @param string $nom
     * @return Utilisateur
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string 
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set pwd
     *
     * @param string $pwd
     * @return Utilisateur
     */
    public function setPwd($pwd)
    {
        $this->pwd = $pwd;

        return $this;
    }

    /**
     * Get pwd
     *
     * @return string 
     */
    public function getPwd()
    {
        return $this->pwd;
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
