<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AppBundle\Metier;
use Doctrine\ORM\EntityManager;
use AppBundle\Entity\DemandeService;

/**
 * Description of DemandeServiceMetier
 *
 * @author fd
 */

class DemandeServiceMetier {
    private $em;

    public function __construct(EntityManager $em) {
        $this->em = $em;
    }

    public function getRepository() {
        return $this->em->getRepository("AppBundle:DemandeService");
    }

    public function create(DemandeService $demandeService) {
        $this->em->persist($demandeService);
        $this->em->flush();
        return $demandeService;
    }

    public function delete($id) {
        $demandeService = $this->getRepository()->find($id);
        if ($demandeService) {
            $this->em->remove($demandeService);
            $this->em->flush();
        }
    }

    public function update(DemandeService $demandeService) {
        $this->em->update($demandeService);
        $this->em->flush();
		return $demandeService;
    }

    public function findAll() {
        $this->getRepository()->findAll();
    }
    
	public function find($id) {
        $this->getRepository()->find($id);
    }
}
