<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * DemandeParticipation
 *
 * @ORM\Table(name="demande_participation")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\DemandeParticipationRepository")
 */
class DemandeParticipation
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
     * @var string
     *
     * @ORM\Column(name="motivation", type="text")
     */
    private $motivation;

    /**
    * @ORM\ManyToOne(targetEntity="UserBundle\Entity\Travailleur")
    * @ORM\JoinColumn(nullable=false)
    */
    private $travailleur;

    /**
    * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Projet")
    * @ORM\JoinColumn(nullable=false)
    */
    private $projet;

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
     * @return DemandeParticipation
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
     * @return DemandeParticipation
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
     * Set motivation
     *
     * @param string $motivation
     *
     * @return DemandeParticipation
     */
    public function setMotivation($motivation)
    {
        $this->motivation = $motivation;

        return $this;
    }

    /**
     * Get motivation
     *
     * @return string
     */
    public function getMotivation()
    {
        return $this->motivation;
    }

    /**
     * Set travailleur
     *
     * @param \AppBundle\Entity\Travailleur $travailleur
     *
     * @return DemandeParticipation
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
     * Set projet
     *
     * @param \AppBundle\Entity\Projet $projet
     *
     * @return DemandeParticipation
     */
    public function setProjet(\AppBundle\Entity\Projet $projet)
    {
        $this->projet = $projet;

        return $this;
    }

    /**
     * Get projet
     *
     * @return \AppBundle\Entity\Projet
     */
    public function getProjet()
    {
        return $this->projet;
    }
}
