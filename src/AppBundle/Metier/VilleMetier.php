<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AppBundle\Metier;
use Doctrine\ORM\EntityManager;
use AppBundle\Entity\Ville;

/**
 * Description of VilleMetier
 *
 * @author fd
 */

class VilleMetier {
    private $em;

    public function __construct(EntityManager $em) {
        $this->em = $em;
    }

    public function getRepository() {
        return $this->em->getRepository("AppBundle:Ville");
    }

    public function create(Ville $ville) {
        $this->em->persist($ville);
        $this->em->flush();
        return $ville;
    }

    public function delete($id) {
        $ville = $this->getRepository()->find($id);
        if ($ville) {
            $this->em->remove($ville);
            $this->em->flush();
        }
    }

    public function update(Ville $ville) {
        $this->em->update($ville);
        $this->em->flush();
		return $ville;
    }

    public function findAll() {
        return $this->getRepository()->findAll();
    }
    
	public function find($id) {
        return $this->getRepository()->find($id);
    }
}
