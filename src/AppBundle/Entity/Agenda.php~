<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Agenda
 *
 * @ORM\Table(name="agenda")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\AgendaRepository")
 */
class Agenda
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
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Evenement", mappedBy="agenda")
     */
    private $evenements;


    /**
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\InfosTravailleur", mappedBy="agenda")
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
     * Constructor
     */
    public function __construct()
    {
        $this->evenements = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add evenement
     *
     * @param \AppBundle\Entity\Evenement $evenement
     *
     * @return Agenda
     */
    public function addEvenement(\AppBundle\Entity\Evenement $evenement)
    {
        $this->evenements[] = $evenement;

        return $this;
    }

    /**
     * Remove evenement
     *
     * @param \AppBundle\Entity\Evenement $evenement
     */
    public function removeEvenement(\AppBundle\Entity\Evenement $evenement)
    {
        $this->evenements->removeElement($evenement);
    }

    /**
     * Get evenements
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEvenements()
    {
        return $this->evenements;
    }

    /**
     * Set infosTravailleur
     *
     * @param \AppBundle\Entity\InfosTravailleur $infosTravailleur
     *
     * @return Agenda
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
