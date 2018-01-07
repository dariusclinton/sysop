<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AttributionProjet
 *
 * @ORM\Table(name="attribution_projet")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\AttributionProjetRepository")
 */
class AttributionProjet
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
     * @return AttributionProjet
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
     * Set travailleur
     *
     * @param \AppBundle\Entity\Travailleur $travailleur
     *
     * @return AttributionProjet
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
     * @return AttributionProjet
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
