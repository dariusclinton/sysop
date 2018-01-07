<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ProgrammeLocation
 *
 * @ORM\Table(name="programme_location")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ProgrammeLocationRepository")
 */
class ProgrammeLocation
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
     * @ORM\Column(name="jour", type="string", length=255)
     */
    private $jour;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="heureDebut", type="time")
     */
    private $heureDebut;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="heureFin", type="time")
     */
    private $heureFin;

    /**
     * @var bool
     *
     * @ORM\Column(name="disponible", type="boolean")
     */
    private $disponible;

    /**
    * @ORM\OneToMany(targetEntity="AppBundle\Entity\DemandeLocation", mappedBy="programmeLocation")
    */
    private $demandesLocation;

    /**
    * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Location")
    * @ORM\JoinColumn(nullable=false)
    */
    private $location;
    
    public function __construct()
    {
        $this->heureDebut = new \DateTime();
        $this->heureFin = new \DateTime();
        $this->demandesLocation = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set jour
     *
     * @param string $jour
     *
     * @return DemandeLocation
     */
    public function setJour($jour)
    {
        $this->jour = $jour;

        return $this;
    }

    /**
     * Get jour
     *
     * @return string
     */
    public function getJour()
    {
        return $this->jour;
    }

    /**
     * Set heureDebut
     *
     * @param \DateTime $heureDebut
     *
     * @return DemandeLocation
     */
    public function setHeureDebut($heureDebut)
    {
        $this->heureDebut = $heureDebut;

        return $this;
    }

    /**
     * Get heureDebut
     *
     * @return \DateTime
     */
    public function getHeureDebut()
    {
        return $this->heureDebut;
    }

    /**
     * Set heureFin
     *
     * @param \DateTime $heureFin
     *
     * @return DemandeLocation
     */
    public function setHeureFin($heureFin)
    {
        $this->heureFin = $heureFin;

        return $this;
    }

    /**
     * Get heureFin
     *
     * @return \DateTime
     */
    public function getHeureFin()
    {
        return $this->heureFin;
    }

    /**
     * Set disponible
     *
     * @param boolean $disponible
     *
     * @return DemandeLocation
     */
    public function setDisponible($disponible)
    {
        $this->disponible = $disponible;

        return $this;
    }

    /**
     * Get disponible
     *
     * @return boolean
     */
    public function getDisponible()
    {
        return $this->disponible;
    }

    /**
     * Add demandesLocation
     *
     * @param \AppBundle\Entity\DemandeLocation $demandesLocation
     *
     * @return ProgrammeLocation
     */
    public function addDemandesLocation(\AppBundle\Entity\DemandeLocation $demandesLocation)
    {
        $this->demandesLocation[] = $demandesLocation;

        return $this;
    }

    /**
     * Remove demandesLocation
     *
     * @param \AppBundle\Entity\DemandeLocation $demandesLocation
     */
    public function removeDemandesLocation(\AppBundle\Entity\DemandeLocation $demandesLocation)
    {
        $this->demandesLocation->removeElement($demandesLocation);
    }

    /**
     * Get demandesLocation
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getDemandesLocation()
    {
        return $this->demandesLocation;
    }

    /**
     * Set location
     *
     * @param \AppBundle\Entity\Location $location
     *
     * @return ProgrammeLocation
     */
    public function setLocation(\AppBundle\Entity\Location $location)
    {
        $this->location = $location;

        return $this;
    }

    /**
     * Get location
     *
     * @return \AppBundle\Entity\Location
     */
    public function getLocation()
    {
        return $this->location;
    }

    public function __toString()
    {
        return $this->getLocation()->getLibelle() .' | '. $this->getJour() .' de '. $this->getHeureDebut()->format('H:m')
            .' à '. $this->getHeureFin()->format('H:m');
    }
}
