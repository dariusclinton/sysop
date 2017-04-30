<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AppBundle\Dao;
use Doctrine\ORM\EntityManager;
use AppBundle\Entity\Admin;

/**
 * Description of AdminDao
 *
 * @author fd
 */

class AdminDao {
    private $em;

    public function __construct(EntityManager $em) {
        $this->em = $em;
    }

    public function getRepository() {
        return $this->em->getRepository("AppBundle:Admin");
    }

    public function create(Admin $admin) {
        $this->em->persist($admin);
        $this->em->flush();
        return $admin;
    }

    public function delete(Admin $admin) {
        $this->em->remove($admin);
        $this->em->flush();
    }

    public function update(Admin $admin) {
        $this->em->update($admin);
        $this->em->flush();
		return $admin;
    }

    public function findAll() {
        $this->getRepository()->findAll();
    }
    
	public function find($id) {
        $this->getRepository()->find($id);
    }
}
