<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Specialite
 *
 * @ORM\Table(name="specialite")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\SpecialiteRepository")
 */
class Specialite
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255)
     */
    private $description;

    /**
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\InfosTravailleur", mappedBy="specialite")
     */
    private $InfosTravailleurs;

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
     * @return Specialite
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
     * Set description
     *
     * @param string $description
     *
     * @return Specialite
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
     * Constructor
     */
    public function __construct()
    {
        $this->InfosTravailleurs = new \Doctrine\Common\Collections\ArrayCollection();
    }


    /**
     * Add infosTravailleur
     *
     * @param \AppBundle\Entity\InfosTravailleur $infosTravailleur
     *
     * @return Specialite
     */
    public function addInfosTravailleur(\AppBundle\Entity\InfosTravailleur $infosTravailleur)
    {
        $this->InfosTravailleurs[] = $infosTravailleur;

        return $this;
    }

    /**
     * Remove infosTravailleur
     *
     * @param \AppBundle\Entity\InfosTravailleur $infosTravailleur
     */
    public function removeInfosTravailleur(\AppBundle\Entity\InfosTravailleur $infosTravailleur)
    {
        $this->InfosTravailleurs->removeElement($infosTravailleur);
    }

    /**
     * Get infosTravailleurs
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getInfosTravailleurs()
    {
        return $this->InfosTravailleurs;
    }
}
