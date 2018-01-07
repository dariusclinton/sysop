<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Solliciter
 *
 * @ORM\Table(name="solliciter")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\SolliciterRepository")
 */
class Solliciter
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
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;

    /**
     * @var bool
     *
     * @ORM\Column(name="valide", type="boolean")
     */
    private $valide;

    /**
    * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Travailleur")
    * @ORM\JoinColumn(nullable=false)
    */
    private $travailleur;

    /**
    * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Utilisateur")
    * @ORM\JoinColumn(nullable=false)
    */
    private $utilisateur;

    public function __construct()
    {
        $this->date = new \DateTime();
        $this->valide = false;
    }

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
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Solliciter
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set valide
     *
     * @param boolean $valide
     *
     * @return Solliciter
     */
    public function setValide($valide)
    {
        $this->valide = $valide;

        return $this;
    }

    /**
     * Get valide
     *
     * @return bool
     */
    public function getValide()
    {
        return $this->valide;
    }

    /**
     * Set travailleur
     *
     * @param \AppBundle\Entity\Travailleur $travailleur
     *
     * @return Solliciter
     */
    public function setTravailleur(\AppBundle\Entity\Travailleur $travailleur)
    {
        $this->travailleur = $travailleur;

        return $this;
    }

    /**
     * Get travailleur
     *
     * @return \AppBundle\Entity\Travailleur
     */
    public function getTravailleur()
    {
        return $this->travailleur;
    }

    /**
     * Set utilisateur
     *
     * @param \AppBundle\Entity\Utilisateur $utilisateur
     *
     * @return Solliciter
     */
    public function setUtilisateur(\AppBundle\Entity\Utilisateur $utilisateur)
    {
        $this->utilisateur = $utilisateur;

        return $this;
    }

    /**
     * Get utilisateur
     *
     * @return \AppBundle\Entity\Utilisateur
     */
    public function getUtilisateur()
    {
        return $this->utilisateur;
    }
}
