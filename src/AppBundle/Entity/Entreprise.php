<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use PUGX\MultiUserBundle\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity
 * @ORM\Table(name="entreprise")
 * @UniqueEntity(fields = "username", targetClass = "AppBundle\Entity\Utilisateur", message="fos_user.username.already_used")
 * @UniqueEntity(fields = "email", targetClass = "AppBundle\Entity\Utilisateur", message="fos_user.email.already_used")
 */
class Entreprise extends Utilisateur
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $lattitude;

    /**
     * @ORM\Column(type="integer")
     */
    private $longitude;

    /**
     * @ORM\Column(type="string")
     */
    private $nbEmploye;

    public function __construct()
    {
        parent::__construct();
        $this->roles = array('ROLE_ENTREPRISE');
    }

    /**
     * Set lattitude
     *
     * @param integer $lattitude
     *
     * @return Entreprise
     */
    public function setLattitude($lattitude)
    {
        $this->lattitude = $lattitude;

        return $this;
    }

    /**
     * Get lattitude
     *
     * @return integer
     */
    public function getLattitude()
    {
        return $this->lattitude;
    }

    /**
     * Set longitude
     *
     * @param integer $longitude
     *
     * @return Entreprise
     */
    public function setLongitude($longitude)
    {
        $this->longitude = $longitude;

        return $this;
    }

    /**
     * Get longitude
     *
     * @return integer
     */
    public function getLongitude()
    {
        return $this->longitude;
    }

    /**
     * Set nbEmploye
     *
     * @param string $nbEmploye
     *
     * @return Entreprise
     */
    public function setNbEmploye($nbEmploye)
    {
        $this->nbEmploye = $nbEmploye;

        return $this;
    }

    /**
     * Get nbEmploye
     *
     * @return string
     */
    public function getNbEmploye()
    {
        return $this->nbEmploye;
    }
}
