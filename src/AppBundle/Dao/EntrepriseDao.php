<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AppBundle\Dao;
use Doctrine\ORM\EntityManager;
use AppBundle\Entity\Entreprise;

/**
 * Description of EntrepriseDao
 *
 * @author fd
 */

class EntrepriseDao {
    private $em;

    public function __construct(EntityManager $em) {
        $this->em = $em;
    }

    public function getRepository() {
        return $this->em->getRepository("AppBundle:Entreprise");
    }

    public function create(Entreprise $entreprise) {
        $this->em->persist($entreprise);
        $this->em->flush();
        return $entreprise;
    }

    public function delete(Entreprise $entreprise) {
        $this->em->remove($entreprise);
        $this->em->flush();
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
