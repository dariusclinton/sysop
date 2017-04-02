<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Projet
 *
 * @ORM\Table(name="projet")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ProjetRepository")
 */
class Projet
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
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;
    
    /**
    * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Utilisateur")
    * @ORM\JoinColumn(nullable=false)
    */
    private $utilisateur;

    /**
    * @ORM\OneToMany(targetEntity="AppBundle\Entity\AttributionProjet", mappedBy="projet")
    */
    private $attributionsProjet;

    /**
    * @ORM\OneToMany(targetEntity="AppBundle\Entity\DemandeParticipation", mappedBy="projet")
    */
    private $demandesParticipation;

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
     * @return Projet
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
     * Set description
     *
     * @param string $description
     *
     * @return Projet
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
        $this->attributionsProjet = new \Doctrine\Common\Collections\ArrayCollection();
        $this->demandesParticipation = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set utilisateur
     *
     * @param \AppBundle\Entity\Utilisateur $utilisateur
     *
     * @return Projet
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
     * Add attributionsProjet
     *
     * @param \AppBundle\Entity\AttributionProjet $attributionsProjet
     *
     * @return Projet
     */
    public function addAttributionsProjet(\AppBundle\Entity\AttributionProjet $attributionsProjet)
    {
        $this->attributionsProjet[] = $attributionsProjet;

        return $this;
    }

    /**
     * Remove attributionsProjet
     *
     * @param \AppBundle\Entity\AttributionProjet $attributionsProjet
     */
    public function removeAttributionsProjet(\AppBundle\Entity\AttributionProjet $attributionsProjet)
    {
        $this->attributionsProjet->removeElement($attributionsProjet);
    }

    /**
     * Get attributionsProjet
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAttributionsProjet()
    {
        return $this->attributionsProjet;
    }

    /**
     * Add demandesParticipation
     *
     * @param \AppBundle\Entity\DemandeParticipation $demandesParticipation
     *
     * @return Projet
     */
    public function addDemandesParticipation(\AppBundle\Entity\DemandeParticipation $demandesParticipation)
    {
        $this->demandesParticipation[] = $demandesParticipation;

        return $this;
    }

    /**
     * Remove demandesParticipation
     *
     * @param \AppBundle\Entity\DemandeParticipation $demandesParticipation
     */
    public function removeDemandesParticipation(\AppBundle\Entity\DemandeParticipation $demandesParticipation)
    {
        $this->demandesParticipation->removeElement($demandesParticipation);
    }

    /**
     * Get demandesParticipation
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getDemandesParticipation()
    {
        return $this->demandesParticipation;
    }
}
