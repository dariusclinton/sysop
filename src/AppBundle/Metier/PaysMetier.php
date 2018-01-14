<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AppBundle\Metier;
use Doctrine\ORM\EntityManager;
use AppBundle\Entity\Pays;

/**
 * Description of PaysMetier
 *
 * @author fd
 */

class PaysMetier {
    private $em;

    public function __construct(EntityManager $em) {
        $this->em = $em;
    }

    public function getRepository() {
        return $this->em->getRepository("AppBundle:Pays");
    }

    public function create(Pays $pays) {
        $this->em->persist($pays);
        $this->em->flush();
        return $pays;
    }

    public function delete($id) {
        $pays = $this->getRepository()->find($id);
        if ($pays) {
            $this->em->remove($pays);
            $this->em->flush();
        }
    }

    public function update(Pays $pays) {
        $this->em->update($pays);
        $this->em->flush();
		return $pays;
    }

    public function findAll() {
        return $this->getRepository()->findAll();
    }
    
	public function find($id) {
        return $this->getRepository()->find($id);
    }
}
