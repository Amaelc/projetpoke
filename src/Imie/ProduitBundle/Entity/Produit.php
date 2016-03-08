<?php

namespace Imie\ProduitBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * Produit
 *
 * @ORM\Table(name="produit", indexes={@ORM\Index(name="idImage", columns={"idImage"}), @ORM\Index(name="idCategorie", columns={"idCategorie"})})
 * @ORM\Entity(repositoryClass="Imie\ProduitBundle\Repository\ProduitRepository")
 */
class Produit
{
    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=30, nullable=false)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=100, nullable=false)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="prix", type="decimal", precision=10, scale=0, nullable=true)
     */
    private $prix;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \Imie\ProduitBundle\Entity\Categorie
     *
     * @ORM\ManyToOne(targetEntity="Imie\ProduitBundle\Entity\Categorie")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idCategorie", referencedColumnName="id")
     * })
     * @Assert\Type(type="\Imie\ProduitBundle\Entity\Categorie",message="Le champ saisi {{ value }} n'est pas un {{ type }}")
     * @Assert\NotBlank(message="Ce champ ne peut pas être vide.")
     */
    private $idcategorie;

    /**
     * @var \Imie\ProduitBundle\Entity\Image
     *
     * ManyToOne(targetEntity="Imie\ProduitBundle\Entity\Image")
     * @ORM\OneToOne(targetEntity="Imie\ProduitBundle\Entity\Image")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idImage", referencedColumnName="id")
     * })
     */
    private $idimage;

    /* 
     * Bidirectional 
     * ORM\ManyToMany(targetEntity="Genre", inversedBy="listeDesFilms")
     * ORM\JoinTable(name="_assoc_film_genre",
     *   joinColumns={ORM\JoinColumn(name="user_id", referencedColumnName="id")},
     *   inverseJoinColumns={ORM\JoinColumn(name="film_id", referencedColumnName="id")}
     * )
    protected $listeDesGenres;
     */
    
    /**
     * liste des stocks d'un produit
     * @var \Imie\ProduitBundle\Entity\Stock
     * * Unidirectional 
     * @ORM\OneToMany(targetEntity="Imie\ProduitBundle\Entity\Stock", mappedBy="idproduit")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id", referencedColumnName="idproduit")
     * })
     */
    protected $listeStock;

    
    
    
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
    
     /**
     * Add listeStock
     *
     * @param \Imie\ProduitBundleEntity\Stock $listeStock
     * @return Produit
     */
    public function addListeStock(\Imie\ProduitBundle\Entity\Stock $listeStock)
    {
        $this->listeStock[] = $listeStock;

        return $this;
    }

    /**
     * Remove listeStock
     *
     * @param \Imie\ProduitBundle\EntityStovk $listeStock
     */
    public function removeListeStock(\Imie\ProduitBundle\Entity\Stock $listeStock)
    {
        $this->listeStock->removeElement($listeStock);
    }

    /**
     * Get listeStock
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getListeStock()
    {
        return $this->listeStock;
    }
    
    public function __tostring()
    {
        return $this->getNom();
    }
}
