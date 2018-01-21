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
     * @ORM\Column(type="decimal", nullable=true)
     */
    private $tarif;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="date")
     */
    private $dateDebut;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="date")
     */
    private $dateFin;
    
    /**
    * @ORM\ManyToOne(targetEntity="UserBundle\Entity\Utilisateur")
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
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Ville")
     */
    private $villes;

    /**
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Specialite")
     */
    private $specialites;

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

    /**
     * Add ville
     *
     * @param \AppBundle\Entity\Ville $ville
     *
     * @return Projet
     */
    public function addVille(\AppBundle\Entity\Ville $ville)
    {
        $this->villes[] = $ville;

        return $this;
    }

    /**
     * Remove ville
     *
     * @param \AppBundle\Entity\Ville $ville
     */
    public function removeVille(\AppBundle\Entity\Ville $ville)
    {
        $this->villes->removeElement($ville);
    }

    /**
     * Get villes
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getVilles()
    {
        return $this->villes;
    }

    public function __toString()
    {
        return $this->getLibelle();
    }

    /**
     * Set dateDebut
     *
     * @param \DateTime $dateDebut
     *
     * @return Projet
     */
    public function setDateDebut($dateDebut)
    {
        $this->dateDebut = $dateDebut;

        return $this;
    }

    /**
     * Get dateDebut
     *
     * @return \DateTime
     */
    public function getDateDebut()
    {
        return $this->dateDebut;
    }

    /**
     * Set dateFin
     *
     * @param \DateTime $dateFin
     *
     * @return Projet
     */
    public function setDateFin($dateFin)
    {
        $this->dateFin = $dateFin;

        return $this;
    }

    /**
     * Get dateFin
     *
     * @return \DateTime
     */
    public function getDateFin()
    {
        return $this->dateFin;
    }

    /**
     * Add specialite
     *
     * @param \AppBundle\Entity\Specialite $specialite
     *
     * @return Projet
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
     * Set tarif
     *
     * @param string $tarif
     *
     * @return Projet
     */
    public function setTarif($tarif)
    {
        $this->tarif = $tarif;

        return $this;
    }

    /**
     * Get tarif
     *
     * @return string
     */
    public function getTarif()
    {
        return $this->tarif;
    }

    /**
     * Set utilisateur
     *
     * @param \UserBundle\Entity\Utilisateur $utilisateur
     *
     * @return Projet
     */
    public function setUtilisateur(\UserBundle\Entity\Utilisateur $utilisateur)
    {
        $this->utilisateur = $utilisateur;

        return $this;
    }

    /**
     * Get utilisateur
     *
     * @return \UserBundle\Entity\Utilisateur
     */
    public function getUtilisateur()
    {
        return $this->utilisateur;
    }
}
