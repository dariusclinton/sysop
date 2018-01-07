<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AppBundle\Metier;
use Doctrine\ORM\EntityManager;
use AppBundle\Entity\Programme;

/**
 * Description of ProgrammeMetier
 *
 * @author fd
 */

class ProgrammeMetier {
    private $em;

    public function __construct(EntityManager $em) {
        $this->em = $em;
    }

    public function getRepository() {
        return $this->em->getRepository("AppBundle:Programme");
    }

    public function create(Programme $programme) {
        $this->em->persist($programme);
        $this->em->flush();
        return $programme;
    }

    public function delete($id) {
        $programme = $this->getRepository()->find($id);
        if ($programme) {
            $this->em->remove($programme);
            $this->em->flush();
        }
    }

    public function update(Programme $programme) {
        $this->em->update($programme);
        $this->em->flush();
		return $programme;
    }

    public function findAll() {
        $this->getRepository()->findAll();
    }
    
	public function find($id) {
        $this->getRepository()->find($id);
    }
}
