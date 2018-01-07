<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AppBundle\Metier;
use Doctrine\ORM\EntityManager;
use AppBundle\Entity\DemandeLocation;

/**
 * Description of DemandeLocationMetier
 *
 * @author fd
 */

class DemandeLocationMetier {
    private $em;

    public function __construct(EntityManager $em) {
        $this->em = $em;
    }

    public function getRepository() {
        return $this->em->getRepository("AppBundle:DemandeLocation");
    }

    public function create(DemandeLocation $demandeLocation) {
        $this->em->persist($demandeLocation);
        $this->em->flush();
        return $demandeLocation;
    }

    public function delete($id) {
        $demandeLocation = $this->getRepository()->find($id);
        if ($demandeLocation) {
            $this->em->remove($demandeLocation);
            $this->em->flush();
        }
    }

    public function update(DemandeLocation $demandeLocation) {
        $this->em->update($demandeLocation);
        $this->em->flush();
		return $demandeLocation;
    }

    public function findAll() {
        $this->getRepository()->findAll();
    }
    
	public function find($id) {
        $this->getRepository()->find($id);
    }
}
