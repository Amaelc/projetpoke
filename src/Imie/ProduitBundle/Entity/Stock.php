<?php

namespace Imie\ProduitBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\OneToMany;

use Imie\ProduitBundle\Repository\StockRepository;
/**
 * Stock
 *
 * @ORM\Table(name="stock", indexes={@ORM\Index(name="idUtilisateur", columns={"idUtilisateur"}), @ORM\Index(name="idProduit", columns={"idProduit"}), @ORM\Index(name="idCouleur", columns={"idCouleur"}), @ORM\Index(name="idTaille", columns={"idTaille"}), @ORM\Index(name="idFournisseur", columns={"idFournisseur"})})
 * @ORM\Entity(repositoryClass="Imie\ProduitBundle\Repository\StockRepository")
 */
class Stock
{
    /**
     * @var integer
     *
     * @ORM\Column(name="qteStock", type="integer", nullable=false)
     */
    private $qtestock;

    /**
     * @var integer
     *
     * @ORM\Column(name="qteDefectueux", type="integer", nullable=false)
     */
    private $qtedefectueux;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateAchat", type="date", nullable=true)
     */
    private $dateachat;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \Imie\ProduitBundle\Entity\Utilisateur
     *
     * @ORM\ManyToOne(targetEntity="Imie\ProduitBundle\Entity\Utilisateur")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idUtilisateur", referencedColumnName="id")
     * })
     */
    private $idutilisateur;

    /**
     * @var \Imie\ProduitBundle\Entity\Fournisseur
     *
     * @ORM\ManyToOne(targetEntity="Imie\ProduitBundle\Entity\Fournisseur")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idFournisseur", referencedColumnName="id")
     * })
     */
    private $idfournisseur;

    /**
     * @var \Imie\ProduitBundle\Entity\Taille
     *
     * @ORM\ManyToOne(targetEntity="Imie\ProduitBundle\Entity\Taille" , cascade={"all"}, fetch="EAGER")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idTaille", referencedColumnName="id")
     * })
     */
    private $idtaille;

    /**
     * @var \Imie\ProduitBundle\Entity\Couleur
     *
     * @ORM\ManyToOne(targetEntity="Imie\ProduitBundle\Entity\Couleur" , cascade={"all"}, fetch="EAGER")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idCouleur", referencedColumnName="id")
     * })
     */
    private $idcouleur;

    /**
     * @var \Imie\ProduitBundle\Entity\Produit
     *
     * @ORM\ManyToOne(targetEntity="Imie\ProduitBundle\Entity\Produit" )
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idProduit", referencedColumnName="id")
     * })
     */
    private $idproduit;

    /**
     * Set qtestock
     *
     * @param integer $qtestock
     * @return Stock
     */
    public function setQtestock($qtestock)
    {
        $this->qtestock = $qtestock;

        return $this;
    }

    /**
     * Get qtestock
     *
     * @return integer 
     */
    public function getQtestock()
    {
        return $this->qtestock;
    }

    /**
     * Set qtedefectueux
     *
     * @param integer $qtedefectueux
     * @return Stock
     */
    public function setQtedefectueux($qtedefectueux)
    {
        $this->qtedefectueux = $qtedefectueux;

        return $this;
    }

    /**
     * Get qtedefectueux
     *
     * @return integer 
     */
    public function getQtedefectueux()
    {
        return $this->qtedefectueux;
    }

    /**
     * Set dateachat
     *
     * @param \DateTime $dateachat
     * @return Stock
     */
    public function setDateachat($dateachat)
    {
        $this->dateachat = $dateachat;

        return $this;
    }

    /**
     * Get dateachat
     *
     * @return \DateTime 
     */
    public function getDateachat()
    {
        return $this->dateachat;
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
     * Set idutilisateur
     *
     * @param \Imie\ProduitBundle\Entity\Utilisateur $idutilisateur
     * @return Stock
     */
    public function setIdutilisateur(\Imie\ProduitBundle\Entity\Utilisateur $idutilisateur = null)
    {
        $this->idutilisateur = $idutilisateur;

        return $this;
    }

    /**
     * Get idutilisateur
     *
     * @return \Imie\ProduitBundle\Entity\Utilisateur 
     */
    public function getIdutilisateur()
    {
        return $this->idutilisateur;
    }

    /**
     * Set idfournisseur
     *
     * @param \Imie\ProduitBundle\Entity\Fournisseur $idfournisseur
     * @return Stock
     */
    public function setIdfournisseur(\Imie\ProduitBundle\Entity\Fournisseur $idfournisseur = null)
    {
        $this->idfournisseur = $idfournisseur;

        return $this;
    }

    /**
     * Get idfournisseur
     *
     * @return \Imie\ProduitBundle\Entity\Fournisseur 
     */
    public function getIdfournisseur()
    {
        return $this->idfournisseur;
    }

    /**
     * Set idtaille
     *
     * @param \Imie\ProduitBundle\Entity\Taille $idtaille
     * @return Stock
     */
    public function setIdtaille(\Imie\ProduitBundle\Entity\Taille $idtaille = null)
    {
        $this->idtaille = $idtaille;

        return $this;
    }

    /**
     * Get idtaille
     *
     * @return \Imie\ProduitBundle\Entity\Taille 
     */
    public function getIdtaille()
    {
        return $this->idtaille;
    }

    /**
     * Set idcouleur
     *
     * @param \Imie\ProduitBundle\Entity\Couleur $idcouleur
     * @return Stock
     */
    public function setIdcouleur(\Imie\ProduitBundle\Entity\Couleur $idcouleur = null)
    {
        $this->idcouleur = $idcouleur;

        return $this;
    }

    /**
     * Get idcouleur
     *
     * @return \Imie\ProduitBundle\Entity\Couleur 
     */
    public function getIdcouleur()
    {
        return $this->idcouleur;
    }

    /**
     * Set idproduit
     *
     * @param \Imie\ProduitBundle\Entity\Produit $idproduit
     * @return Stock
     */
    public function setIdproduit(\Imie\ProduitBundle\Entity\Produit $idproduit = null)
    {
        $this->idproduit = $idproduit;

        return $this;
    }

    /**
     * Get idproduit
     *
     * @return \Imie\ProduitBundle\Entity\Produit 
     */
    public function getIdproduit()
    {
        return $this->idproduit;
    }
}
