<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AppBundle\Metier;
use Doctrine\ORM\EntityManager;
use AppBundle\Entity\DemandeParticipation;

/**
 * Description of DemandeParticipationMetier
 *
 * @author fd
 */

class DemandeParticipationMetier {
    private $em;

    public function __construct(EntityManager $em) {
        $this->em = $em;
    }

    public function getRepository() {
        return $this->em->getRepository("AppBundle:DemandeParticipation");
    }

    public function create(DemandeParticipation $demandeParticipation) {
        $this->em->persist($demandeParticipation);
        $this->em->flush();
        return $demandeParticipation;
    }

    public function delete($id) {
        $demandeParticipation = $this->getRepository()->find($id);
        if ($demandeParticipation) {
            $this->em->remove($demandeParticipation);
            $this->em->flush();
        }
    }

    public function update(DemandeParticipation $demandeParticipation) {
        $this->em->update($demandeParticipation);
        $this->em->flush();
		return $demandeParticipation;
    }

    public function findAll() {
        $this->getRepository()->findAll();
    }
    
	public function find($id) {
        $this->getRepository()->find($id);
    }
}
