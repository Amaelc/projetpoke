<?php

namespace Imie\ProduitBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * Image
 *
 * @ORM\Table(name="image")
 * @ORM\Entity
 */
class Image
{
    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=100, nullable=false)
     * @Assert\Type(type="string",message="Le champ saisi {{ value }} n'est pas un {{ type }}")
     * @Assert\NotBlank(message="Ce champ ne peut pas être vide.")
     */
    private $nom;
    
    
    
    /**
     * @var string
     */
    public $fichier;

    /**
     * @var string
     *
     * @ORM\Column(name="alt", type="string", length=500, nullable=true)
     * @Assert\Type(type="string",message="Le champ saisi {{ value }} n'est pas un {{ type }}")
     * @Assert\NotBlank(message="Ce champ ne peut pas être vide.")
     */
    private $alt;

    /**
     * @var string
     *
     * @ORM\Column(name="url", type="string", length=500, nullable=true)
     */
    private $url;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;



    /**
     * Set nom
     *
     * @param string $nom
     * @return Image
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
     * Set alt
     *
     * @param string $alt
     * @return Image
     */
    public function setAlt($alt)
    {
        $this->alt = $alt;

        return $this;
    }

    /**
     * Get alt
     *
     * @return string 
     */
    public function getAlt()
    {
        return $this->alt;
    }

    /**
     * Set url
     *
     * @param string $url
     * @return Image
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get url
     *
     * @return string 
     */
    public function getUrl()
    {
        return $this->url;
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
