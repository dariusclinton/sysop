<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Location
 *
 * @ORM\Table(name="location")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\LocationRepository")
 */
class Location
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
     * @ORM\Column(name="libelle", type="string", length=255)
     */
    private $libelle;

    /**
     * @var int
     *
     * @ORM\Column(name="montant", type="integer", nullable=true)
     */
    private $montant;

    /**
    * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Utilisateur")
    * @ORM\JoinColumn(nullable=false)
    */
    private $utilisateur;

    /**
    * @ORM\OneToMany(targetEntity="AppBundle\Entity\ProgrammeLocation", mappedBy="location")
    */
    private $programmesLocation;


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
     * Set libelle
     *
     * @param string $libelle
     *
     * @return Location
     */
    public function setLibelle($libelle)
    {
        $this->libelle = $libelle;

        return $this;
    }

    /**
     * Get libelle
     *
     * @return string
     */
    public function getLibelle()
    {
        return $this->libelle;
    }

    /**
     * Set montant
     *
     * @param integer $montant
     *
     * @return Location
     */
    public function setMontant($montant)
    {
        $this->montant = $montant;

        return $this;
    }

    /**
     * Get montant
     *
     * @return int
     */
    public function getMontant()
    {
        return $this->montant;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->programmesLocation = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set utilisateur
     *
     * @param \AppBundle\Entity\Utilisateur $utilisateur
     *
     * @return Location
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
     * Add programmesLocation
     *
     * @param \AppBundle\Entity\ProgrammeLocation $programmesLocation
     *
     * @return Location
     */
    public function addProgrammesLocation(\AppBundle\Entity\ProgrammeLocation $programmesLocation)
    {
        $this->programmesLocation[] = $programmesLocation;

        return $this;
    }

    /**
     * Remove programmesLocation
     *
     * @param \AppBundle\Entity\ProgrammeLocation $programmesLocation
     */
    public function removeProgrammesLocation(\AppBundle\Entity\ProgrammeLocation $programmesLocation)
    {
        $this->programmesLocation->removeElement($programmesLocation);
    }

    /**
     * Get programmesLocation
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getProgrammesLocation()
    {
        return $this->programmesLocation;
    }

    public function __toString()
    {
        return $this->getLibelle();
    }
}
