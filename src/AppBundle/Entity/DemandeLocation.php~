<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * DemandeLocation
 *
 * @ORM\Table(name="demande_location")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\DemandeLocationRepository")
 */
class DemandeLocation
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
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;

    /**
    * @ORM\ManyToOne(targetEntity="UserBundle\Entity\Utilisateur")
    * @ORM\JoinColumn(nullable=false)
    */
    private $utilisateur;

    /**
    * @ORM\ManyToOne(targetEntity="AppBundle\Entity\ProgrammeLocation")
    * @ORM\JoinColumn(nullable=false)
    */
    private $programmeLocation;

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
     * @return DemandeLocation
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
     * @return DemandeLocation
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
     * Set description
     *
     * @param string $description
     *
     * @return DemandeLocation
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
     * Set utilisateur
     *
     * @param \AppBundle\Entity\Utilisateur $utilisateur
     *
     * @return DemandeLocation
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

    /**
     * Set programmeLocation
     *
     * @param \AppBundle\Entity\ProgrammeLocation $programmeLocation
     *
     * @return DemandeLocation
     */
    public function setProgrammeLocation(\AppBundle\Entity\ProgrammeLocation $programmeLocation)
    {
        $this->programmeLocation = $programmeLocation;

        return $this;
    }

    /**
     * Get programmeLocation
     *
     * @return \AppBundle\Entity\ProgrammeLocation
     */
    public function getProgrammeLocation()
    {
        return $this->programmeLocation;
    }
}
