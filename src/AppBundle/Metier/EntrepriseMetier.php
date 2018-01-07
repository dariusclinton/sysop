<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AppBundle\Metier;
use Doctrine\ORM\EntityManager;
use UserBundle\Entity\Entreprise;

/**
 * Description of EntrepriseMetier
 *
 * @author fd
 */

class EntrepriseMetier {
    private $em;

    public function __construct(EntityManager $em) {
        $this->em = $em;
    }

    public function getRepository() {
        return $this->em->getRepository("UserBundle:Entreprise");
    }

    public function create(Entreprise $entreprise) {
        $this->em->persist($entreprise);
        $this->em->flush();
        return $entreprise;
    }

    public function delete($id) {
        $entreprise = $this->getRepository()->find($id);
        if ($entreprise) {
            $this->em->remove($entreprise);
            $this->em->flush();
        }
    }

    public function update(Entreprise $entreprise) {
        $this->em->update($entreprise);
        $this->em->flush();
		return $entreprise;
    }

    public function findAll() {
        $this->getRepository()->findAll();
    }
    
	public function find($id) {
        $this->getRepository()->find($id);
    }
}
