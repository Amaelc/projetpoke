<?php

namespace Imie\ProduitBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Taille
 *
 * @ORM\Table(name="taille")
 * @ORM\Entity
 */
class Taille
{
    /**
     * @var string
     *
     * @ORM\Column(name="taille", type="string", length=10, nullable=true)
     */
    private $taille;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;



    /**
     * Set taille
     *
     * @param string $taille
     * @return Taille
     */
    public function setTaille($taille)
    {
        $this->taille = $taille;

        return $this;
    }

    /**
     * Get taille
     *
     * @return string 
     */
    public function getTaille()
    {
        return $this->taille;
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
