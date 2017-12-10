<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * InfosTravailleur
 *
 * @ORM\Table(name="infos_travailleur")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\InfosTravailleurRepository")
 */
class InfosTravailleur
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
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\Agenda")
     * @ORM\JoinColumn(nullable=false)
     */
    private $agenda;

    /**
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\Travailleur", mappedBy="travailleur")
     * @ORM\JoinColumn(nullable=false)
     */
    private $travailleur;

    /**
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Specialite")
     */
    private $specialites;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Experience", mappedBy="infosTravailleur", cascade={"persist","remove"})
     */
    private $experiences;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Diplome", mappedBy="infosTravailleur", cascade={"persist","remove"})
     */
    private $diplomes;

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
     * Constructor
     */
    public function __construct()
    {
        $this->specialites = new \Doctrine\Common\Collections\ArrayCollection();
        $this->experiences = new \Doctrine\Common\Collections\ArrayCollection();
        $this->diplomes = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set agenda
     *
     * @param \AppBundle\Entity\Agenda $agenda
     *
     * @return InfosTravailleur
     */
    public function setAgenda(\AppBundle\Entity\Agenda $agenda)
    {
        $this->agenda = $agenda;

        return $this;
    }

    /**
     * Get agenda
     *
     * @return \AppBundle\Entity\Agenda
     */
    public function getAgenda()
    {
        return $this->agenda;
    }

    /**
     * Set travailleur
     *
     * @param \AppBundle\Entity\Travailleur $travailleur
     *
     * @return InfosTravailleur
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
     * Add specialite
     *
     * @param \AppBundle\Entity\Specialite $specialite
     *
     * @return InfosTravailleur
     */
    public function addSpecialite(\AppBundle\Entity\Specialite $specialite)
    {
        $this->specialites[] = $specialite;

        return $this;
    }

    /**
     * Remove specialite
     *
     * @param \AppBundle\Entity\Specialite $specialite
     */
    public function removeSpecialite(\AppBundle\Entity\Specialite $specialite)
    {
        $this->specialites->removeElement($specialite);
    }

    /**
     * Get specialites
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSpecialites()
    {
        return $this->specialites;
    }

    /**
     * Add experience
     *
     * @param \AppBundle\Entity\Experience $experience
     *
     * @return InfosTravailleur
     */
    public function addExperience(\AppBundle\Entity\Experience $experience)
    {
        $this->experiences[] = $experience;

        return $this;
    }

    /**
     * Remove experience
     *
     * @param \AppBundle\Entity\Experience $experience
     */
    public function removeExperience(\AppBundle\Entity\Experience $experience)
    {
        $this->experiences->removeElement($experience);
    }

    /**
     * Get experiences
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getExperiences()
    {
        return $this->experiences;
    }

    /**
     * Add diplome
     *
     * @param \AppBundle\Entity\Diplome $diplome
     *
     * @return InfosTravailleur
     */
    public function addDiplome(\AppBundle\Entity\Diplome $diplome)
    {
        $this->diplomes[] = $diplome;

        return $this;
    }

    /**
     * Remove diplome
     *
     * @param \AppBundle\Entity\Diplome $diplome
     */
    public function removeDiplome(\AppBundle\Entity\Diplome $diplome)
    {
        $this->diplomes->removeElement($diplome);
    }

    /**
     * Get diplomes
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getDiplomes()
    {
        return $this->diplomes;
    }
}
