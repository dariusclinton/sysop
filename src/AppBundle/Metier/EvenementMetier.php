<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AppBundle\Metier;
use Doctrine\ORM\EntityManager;
use AppBundle\Entity\Evenement;

/**
 * Description of EvenementMetier
 *
 * @author fd
 */

class EvenementMetier {
    private $em;

    public function __construct(EntityManager $em) {
        $this->em = $em;
    }

    public function getRepository() {
        return $this->em->getRepository("AppBundle:Evenement");
    }

    public function create(Evenement $evenement) {
        $this->em->persist($evenement);
        $this->em->flush();
        return $evenement;
    }

    public function delete($id) {
        $evenement = $this->getRepository()->find($id);
        if ($evenement) {
            $this->em->remove($evenement);
            $this->em->flush();
        }
    }

    public function update(Evenement $evenement) {
        $this->em->merge($evenement);
        $this->em->flush();
		return $evenement;
    }

    public function findAll() {
        return $this->getRepository()->findAll();
    }
    
	public function find($id) {
        return $this->getRepository()->find($id);
    }
}
