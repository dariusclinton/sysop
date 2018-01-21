<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AppBundle\Metier;
use Doctrine\ORM\EntityManager;
use AppBundle\Entity\Utilisateur;

/**
 * Description of UtilisateurMetier
 *
 * @author fd
 */

class UtilisateurMetier {
    private $em;

    public function __construct(EntityManager $em) {
        $this->em = $em;
    }

    public function getRepository() {
        return $this->em->getRepository("UserBundle:Utilisateur");
    }

    public function create(Utilisateur $utilisateur) {
        $this->em->persist($utilisateur);
        $this->em->flush();
        return $utilisateur;
    }

    public function delete($id) {
        $utilisateur = $this->getRepository()->find($id);
        if ($utilisateur) {
            $this->em->remove($utilisateur);
            $this->em->flush();
        }
    }

    public function update(Utilisateur $utilisateur) {
        $this->em->update($utilisateur);
        $this->em->flush();
		return $utilisateur;
    }

    public function findAll() {
        return $this->getRepository()->findAll();
    }
    
	public function find($id) {
        return $this->getRepository()->find($id);
    }
}
