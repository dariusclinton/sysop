<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AppBundle\Dao;
use Doctrine\ORM\EntityManager;
use AppBundle\Entity\Utilisateur;

/**
 * Description of UtilisateurDao
 *
 * @author fd
 */

class UtilisateurDao {
    private $em;

    public function __construct(EntityManager $em) {
        $this->em = $em;
    }

    public function getRepository() {
        return $this->em->getRepository("AppBundle:Utilisateur");
    }

    public function create(Utilisateur $utilisateur) {
        $this->em->persist($utilisateur);
        $this->em->flush();
        return $utilisateur;
    }

    public function delete(Utilisateur $utilisateur) {
        $this->em->remove($utilisateur);
        $this->em->flush();
    }

    public function update(Utilisateur $utilisateur) {
        $this->em->update($utilisateur);
        $this->em->flush();
		return $utilisateur;
    }

    public function findAll() {
        $this->getRepository()->findAll();
    }
    
	public function find($id) {
        $this->getRepository()->find($id);
    }
}
