<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AppBundle\Metier;
use Doctrine\ORM\EntityManager;
use AppBundle\Entity\Specialite;

/**
 * Description of SpecialiteMetier
 *
 * @author fd
 */

class SpecialiteMetier {
    private $em;

    public function __construct(EntityManager $em) {
        $this->em = $em;
    }

    public function getRepository() {
        return $this->em->getRepository("AppBundle:Specialite");
    }

    public function create(Specialite $Specialite) {
        $this->em->persist($Specialite);
        $this->em->flush();
        return $Specialite;
    }

    public function delete($id) {
        $Specialite = $this->getRepository()->find($id);
        if ($Specialite) {
            $this->em->remove($Specialite);
            $this->em->flush();
        }
    }

    public function update(Specialite $Specialite) {
        $this->em->update($Specialite);
        $this->em->flush();
		return $Specialite;
    }

    public function findAll() {
        return $this->getRepository()->findAll();
    }
    
	public function find($id) {
        return $this->getRepository()->find($id);
    }
}
