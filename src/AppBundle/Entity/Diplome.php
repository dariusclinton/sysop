<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Diplome
 *
 * @ORM\Table(name="diplome")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\DiplomeRepository")
 */
class Diplome
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\InfosTravailleur")
     * @ORM\JoinColumn(nullable=false)
     */
    private $infosTravailleur;

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nom
     *
     * @param string $nom
     *
     * @return Diplome
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
     * Set infosTravailleur
     *
     * @param \AppBundle\Entity\InfosTravailleur $infosTravailleur
     *
     * @return Diplome
     */
    public function setInfosTravailleur(\AppBundle\Entity\InfosTravailleur $infosTravailleur)
    {
        $this->infosTravailleur = $infosTravailleur;

        return $this;
    }

    /**
     * Get infosTravailleur
     *
     * @return \AppBundle\Entity\InfosTravailleur
     */
    public function getInfosTravailleur()
    {
        return $this->infosTravailleur;
    }
}
