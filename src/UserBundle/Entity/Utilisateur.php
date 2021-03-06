<?php

namespace UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;

/**
 * Utilisateur
 *
 * @ORM\Table(name="utilisateur")
 * @ORM\Entity
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="typeUtilisateur", type="string")
 * @ORM\DiscriminatorMap({"admin" = "Admin", "travailleur" = "Travailleur", "entreprise" = "Entreprise"})
 */
abstract class Utilisateur extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;


    /**
     * @ORM\Column(name="nom", type="string", length=100)
     */
    protected $nom;

    /**
     * @ORM\Column(name="prenom", type="string", length=100, nullable=true)
     */
    protected $prenom;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    protected $adresse;

    /**
    * @ORM\OneToMany(targetEntity="AppBundle\Entity\Projet", mappedBy="utilisateur")
    */
    protected $projets;

    /**
    * @ORM\OneToMany(targetEntity="AppBundle\Entity\Solliciter", mappedBy="utilisateur")
    */
    protected $sollicites;

    /**
    * @ORM\OneToMany(targetEntity="AppBundle\Entity\DemandeLocation", mappedBy="utilisateur")
    */
    protected $demandesLocation;

    /**
    * @ORM\OneToMany(targetEntity="AppBundle\Entity\DemandeService", mappedBy="utilisateur")
    */
    protected $demandesService;

    /**
    * @ORM\OneToMany(targetEntity="AppBundle\Entity\Location", mappedBy="utilisateur")
    */
    protected $locations;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Ville")
     * @ORM\JoinColumn(nullable=true)
     */
    protected $ville;

    public function __construct()
    {
        parent::__construct();
        // your own logic
    }

    /**
     * Add projet
     *
     * @param \AppBundle\Entity\Projet $projet
     *
     * @return Utilisateur
     */
    public function addProjet(\AppBundle\Entity\Projet $projet)
    {
        $this->projets[] = $projet;

        return $this;
    }

    /**
     * Remove projet
     *
     * @param \AppBundle\Entity\Projet $projet
     */
    public function removeProjet(\AppBundle\Entity\Projet $projet)
    {
        $this->projets->removeElement($projet);
    }

    /**
     * Get projets
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getProjets()
    {
        return $this->projets;
    }

    /**
     * Add sollicite
     *
     * @param \AppBundle\Entity\Solliciter $sollicite
     *
     * @return Utilisateur
     */
    public function addSollicite(\AppBundle\Entity\Solliciter $sollicite)
    {
        $this->sollicites[] = $sollicite;

        return $this;
    }

    /**
     * Remove sollicite
     *
     * @param \AppBundle\Entity\Solliciter $sollicite
     */
    public function removeSollicite(\AppBundle\Entity\Solliciter $sollicite)
    {
        $this->sollicites->removeElement($sollicite);
    }

    /**
     * Get sollicites
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSollicites()
    {
        return $this->sollicites;
    }

    /**
     * Add demandesLocation
     *
     * @param \AppBundle\Entity\DemandeLocation $demandesLocation
     *
     * @return Utilisateur
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
     * Add demandesService
     *
     * @param \AppBundle\Entity\DemandeService $demandesService
     *
     * @return Utilisateur
     */
    public function addDemandesService(\AppBundle\Entity\DemandeService $demandesService)
    {
        $this->demandesService[] = $demandesService;

        return $this;
    }

    /**
     * Remove demandesService
     *
     * @param \AppBundle\Entity\DemandeService $demandesService
     */
    public function removeDemandesService(\AppBundle\Entity\DemandeService $demandesService)
    {
        $this->demandesService->removeElement($demandesService);
    }

    /**
     * Get demandesService
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getDemandesService()
    {
        return $this->demandesService;
    }

    /**
     * Add location
     *
     * @param \AppBundle\Entity\Location $location
     *
     * @return Utilisateur
     */
    public function addLocation(\AppBundle\Entity\Location $location)
    {
        $this->locations[] = $location;

        return $this;
    }

    /**
     * Remove location
     *
     * @param \AppBundle\Entity\Location $location
     */
    public function removeLocation(\AppBundle\Entity\Location $location)
    {
        $this->locations->removeElement($location);
    }

    /**
     * Get locations
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getLocations()
    {
        return $this->locations;
    }

    /**
     * Set adresse
     *
     * @param string $adresse
     *
     * @return Utilisateur
     */
    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;

        return $this;
    }

    /**
     * Get adresse
     *
     * @return string
     */
    public function getAdresse()
    {
        return $this->adresse;
    }


    /**
     * Set ville
     *
     * @param \AppBundle\Entity\Ville $ville
     *
     * @return Utilisateur
     */
    public function setVille(\AppBundle\Entity\Ville $ville = null)
    {
        $this->ville = $ville;

        return $this;
    }

    /**
     * Get ville
     *
     * @return \AppBundle\Entity\Ville
     */
    public function getVille()
    {
        return $this->ville;
    }

    /**
     * Set nom
     *
     * @param string $nom
     *
     * @return Utilisateur
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
     * Set prenom
     *
     * @param string $prenom
     *
     * @return Utilisateur
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * Get prenom
     *
     * @return string
     */
    public function getPrenom()
    {
        return $this->prenom;
    }
}
