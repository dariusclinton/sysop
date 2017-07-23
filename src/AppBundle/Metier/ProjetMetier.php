<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AppBundle\Metier;
use Doctrine\ORM\EntityManager;
use AppBundle\Entity\Projet;

/**
 * Description of ProjetMetier
 *
 * @author fd
 */

class ProjetMetier {
    private $em;

    public function __construct(EntityManager $em) {
        $this->em = $em;
    }

    public function getRepository() {
        return $this->em->getRepository("AppBundle:Projet");
    }

    public function create(Projet $projet) {
        $this->em->persist($projet);
        $this->em->flush();
        return $projet;
    }

    public function delete($id) {
        $projet = $this->getRepository()->find($id);
        if ($projet) {
            $this->em->remove($projet);
            $this->em->flush();
        }
    }

    public function update(Projet $projet) {
        $this->em->update($projet);
        $this->em->flush();
		return $projet;
    }

    public function findAll() {
        $this->getRepository()->findAll();
    }
    
	public function find($id) {
        $this->getRepository()->find($id);
    }
}
