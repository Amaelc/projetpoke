<?php

namespace Imie\ProduitBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Produit
 */
class Produit
{
    /**
     * @var string
     */
    private $nom;

    /**
     * @var string
     */
    private $description;

    /**
     * @var string
     */
    private $prix;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var \Imie\ProduitBundle\Entity\Categorie
     */
    private $idcategorie;

    /**
     * @var \Imie\ProduitBundle\Entity\Image
     */
    private $idimage;


    /**
     * Set nom
     *
     * @param string $nom
     * @return Produit
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
     * Set description
     *
     * @param string $description
     * @return Produit
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set prix
     *
     * @param string $prix
     * @return Produit
     */
    public function setPrix($prix)
    {
        $this->prix = $prix;

        return $this;
    }

    /**
     * Get prix
     *
     * @return string 
     */
    public function getPrix()
    {
        return $this->prix;
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

    /**
     * Set idcategorie
     *
     * @param \Imie\ProduitBundle\Entity\Categorie $idcategorie
     * @return Produit
     */
    public function setIdcategorie(\Imie\ProduitBundle\Entity\Categorie $idcategorie = null)
    {
        $this->idcategorie = $idcategorie;

        return $this;
    }

    /**
     * Get idcategorie
     *
     * @return \Imie\ProduitBundle\Entity\Categorie 
     */
    public function getIdcategorie()
    {
        return $this->idcategorie;
    }

    /**
     * Set idimage
     *
     * @param \Imie\ProduitBundle\Entity\Image $idimage
     * @return Produit
     */
    public function setIdimage(\Imie\ProduitBundle\Entity\Image $idimage = null)
    {
        $this->idimage = $idimage;

        return $this;
    }

    /**
     * Get idimage
     *
     * @return \Imie\ProduitBundle\Entity\Image 
     */
    public function getIdimage()
    {
        return $this->idimage;
    }
}
