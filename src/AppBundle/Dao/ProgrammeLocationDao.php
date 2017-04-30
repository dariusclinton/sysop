<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AppBundle\Dao;
use Doctrine\ORM\EntityManager;
use AppBundle\Entity\ProgrammeLocation;

/**
 * Description of ProgrammeLocationDao
 *
 * @author fd
 */

class ProgrammeLocationDao {
    private $em;

    public function __construct(EntityManager $em) {
        $this->em = $em;
    }

    public function getRepository() {
        return $this->em->getRepository("AppBundle:ProgrammeLocation");
    }

    public function create(ProgrammeLocation $programmeLocation) {
        $this->em->persist($programmeLocation);
        $this->em->flush();
        return $programmeLocation;
    }

    public function delete(ProgrammeLocation $programmeLocation) {
        $this->em->remove($programmeLocation);
        $this->em->flush();
    }

    public function update(ProgrammeLocation $programmeLocation) {
        $this->em->update($programmeLocation);
        $this->em->flush();
		return $programmeLocation;
    }

    public function findAll() {
        $this->getRepository()->findAll();
    }
    
	public function find($id) {
        $this->getRepository()->find($id);
    }
}
