<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AppBundle\Metier;
use Doctrine\ORM\EntityManager;
use AppBundle\Entity\Agenda;

/**
 * Description of AgendaMetier
 *
 * @author fd
 */

class AgendaMetier {
    private $em;

    public function __construct(EntityManager $em) {
        $this->em = $em;
    }

    public function getRepository() {
        return $this->em->getRepository("AppBundle:Agenda");
    }

    public function create(Agenda $agenda) {
        $this->em->persist($agenda);
        $this->em->flush();
        return $agenda;
    }

    public function delete($id) {
        $agenda = $this->getRepository()->find($id);
        if ($agenda) {
            $this->em->remove($agenda);
            $this->em->flush();
        }
    }

    public function update(Agenda $agenda) {
        $this->em->merge($agenda);
        $this->em->flush();
		return $agenda;
    }

    public function findAll() {
        return $this->getRepository()->findAll();
    }
    
	public function find($id) {
        return $this->getRepository()->find($id);
    }
}
