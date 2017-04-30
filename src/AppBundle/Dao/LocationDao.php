<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AppBundle\Dao;
use Doctrine\ORM\EntityManager;
use AppBundle\Entity\Location;

/**
 * Description of LocationDao
 *
 * @author fd
 */

class LocationDao {
    private $em;

    public function __construct(EntityManager $em) {
        $this->em = $em;
    }

    public function getRepository() {
        return $this->em->getRepository("AppBundle:Location");
    }

    public function create(Location $location) {
        $this->em->persist($location);
        $this->em->flush();
        return $location;
    }

    public function delete(Location $location) {
        $this->em->remove($location);
        $this->em->flush();
    }

    public function update(Location $location) {
        $this->em->update($location);
        $this->em->flush();
		return $location;
    }

    public function findAll() {
        $this->getRepository()->findAll();
    }
    
	public function find($id) {
        $this->getRepository()->find($id);
    }
}
