<?php

namespace UserBundle\Entity;

use AppBundle\Entity\InfosTravailleur;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use PUGX\MultiUserBundle\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity
 * @ORM\Table(name="travailleur")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\TravailleurRepository")
 * @UniqueEntity(fields = "username", targetClass = "UserBundle\Entity\Utilisateur", message="fos_user.username.already_used")
 * @UniqueEntity(fields = "email", targetClass = "UserBundle\Entity\Utilisateur", message="fos_user.email.already_used")
 */
class Travailleur extends Utilisateur
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
    * @ORM\OneToMany(
    *     targetEntity="AppBundle\Entity\Note", 
    *     mappedBy="travailleur", 
    *     cascade={"persist","remove"}
    *)
    */
    private $notes;

    /**
    * @ORM\OneToMany(targetEntity="AppBundle\Entity\AttributionProjet", mappedBy="travailleur")
    */
    private $attributionsProjet;

    /**
    * @ORM\OneToMany(targetEntity="AppBundle\Entity\DemandeParticipation", mappedBy="travailleur")
    */
    private $demandesParticipation;

    /**
    * @ORM\OneToMany(targetEntity="AppBundle\Entity\Solliciter", mappedBy="travailleur")
    */
    protected $sollicites;

    /**
     * @ORM\OneToOne(
     *     targetEntity="AppBundle\Entity\InfosTravailleur", 
     *     inversedBy="travailleur",
     *     cascade={"persist", "remove"}
     * )
     * @ORM\JoinColumn(nullable=true)
     */
    private $infosTravailleur;

    /**
     * @Gedmo\Slug(fields={"nom", "prenom"})
     * @ORM\Column(length=200, unique=true)
     */
    private $slug;
    

    public function __construct()
    {
        parent::__construct();
        $this->roles = array('ROLE_TRAVAILLEUR');
        $this->infosTravailleur = new InfosTravailleur();
    }

    /**
     * Add note
     *
     * @param \AppBundle\Entity\Note $note
     *
     * @return Travailleur
     */
    public function addNote(\AppBundle\Entity\Note $note)
    {
        $this->notes[] = $note;
        $note->setTravailleur($this);

        return $this;
    }

    /**
     * Remove note
     *
     * @param \AppBundle\Entity\Note $note
     */
    public function removeNote(\AppBundle\Entity\Note $note)
    {
        $this->notes->removeElement($note);
    }

    /**
     * Get notes
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getNotes()
    {
        return $this->notes;
    }

    /**
     * Add attributionsProjet
     *
     * @param \AppBundle\Entity\AttributionProjet $attributionsProjet
     *
     * @return Travailleur
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
     * @return Travailleur
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
     * Add sollicite
     *
     * @param \AppBundle\Entity\Solliciter $sollicite
     *
     * @return Travailleur
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
     * Set infosTravailleur
     *
     * @param \AppBundle\Entity\InfosTravailleur $infosTravailleur
     *
     * @return Travailleur
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

    /**
     * Set slug
     *
     * @param string $slug
     *
     * @return Travailleur
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }
}
