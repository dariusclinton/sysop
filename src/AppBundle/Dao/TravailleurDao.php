<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AppBundle\Dao;
use Doctrine\ORM\EntityManager;
use AppBundle\Entity\Travailleur;

/**
 * Description of TravailleurDao
 *
 * @author fd
 */

class TravailleurDao {
    private $em;

    public function __construct(EntityManager $em) {
        $this->em = $em;
    }

    public function getRepository() {
        return $this->em->getRepository("AppBundle:Travailleur");
    }

    public function create(Travailleur $travailleur) {
        $this->em->persist($travailleur);
        $this->em->flush();
        return $travailleur;
    }

    public function delete(Travailleur $travailleur) {
        $this->em->remove($travailleur);
        $this->em->flush();
    }

    public function update(Travailleur $travailleur) {
        $this->em->update($travailleur);
        $this->em->flush();
		return $travailleur;
    }

    public function findAll() {
        $this->getRepository()->findAll();
    }
    
	public function find($id) {
        $this->getRepository()->find($id);
    }
}
