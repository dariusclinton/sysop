<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AppBundle\Dao;
use Doctrine\ORM\EntityManager;
use AppBundle\Entity\DemandeLocation;

/**
 * Description of DemandeLocationDao
 *
 * @author fd
 */

class DemandeLocationDao {
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

    public function delete(DemandeLocation $demandeLocation) {
        $this->em->remove($demandeLocation);
        $this->em->flush();
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
