<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AppBundle\Metier;
use Doctrine\ORM\EntityManager;
use AppBundle\Entity\Solliciter;

/**
 * Description of SolliciterMetier
 *
 * @author fd
 */

class SolliciterMetier {
    private $em;

    public function __construct(EntityManager $em) {
        $this->em = $em;
    }

    public function getRepository() {
        return $this->em->getRepository("AppBundle:Solliciter");
    }

    public function create(Solliciter $solliciter) {
        $this->em->persist($solliciter);
        $this->em->flush();
        return $solliciter;
    }

    public function delete($id) {
        $solliciter = $this->getRepository()->find($id);
        if ($solliciter) {
            $this->em->remove($solliciter);
            $this->em->flush();
        }
    }

    public function update(Solliciter $solliciter) {
        $this->em->update($solliciter);
        $this->em->flush();
		return $solliciter;
    }

    public function findAll() {
        $this->getRepository()->findAll();
    }
    
	public function find($id) {
        $this->getRepository()->find($id);
    }
}
