<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AppBundle\Metier;
use Doctrine\ORM\EntityManager;
use AppBundle\Entity\Diplome;

/**
 * Description of DiplomeMetier
 *
 * @author fd
 */

class DiplomeMetier {
    private $em;

    public function __construct(EntityManager $em) {
        $this->em = $em;
    }

    public function getRepository() {
        return $this->em->getRepository("AppBundle:Diplome");
    }

    public function create(Diplome $diplome) {
        $this->em->persist($diplome);
        $this->em->flush();
        return $diplome;
    }

    public function delete($id) {
        $diplome = $this->getRepository()->find($id);
        if ($diplome) {
            $this->em->remove($diplome);
            $this->em->flush();
        }
    }

    public function update(Diplome $diplome) {
        $this->em->merge($diplome);
        $this->em->flush();
		return $diplome;
    }

    public function findAll() {
        return $this->getRepository()->findAll();
    }
    
	public function find($id) {
        return $this->getRepository()->find($id);
    }
}
