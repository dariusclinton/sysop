<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AppBundle\Metier;
use Doctrine\ORM\EntityManager;
use AppBundle\Entity\Experience;

/**
 * Description of ExperienceMetier
 *
 * @author fd
 */

class ExperienceMetier {
    private $em;

    public function __construct(EntityManager $em) {
        $this->em = $em;
    }

    public function getRepository() {
        return $this->em->getRepository("AppBundle:Experience");
    }

    public function create(Experience $experience) {
        $this->em->persist($experience);
        $this->em->flush();
        return $experience;
    }

    public function delete($id) {
        $experience = $this->getRepository()->find($id);
        if ($experience) {
            $this->em->remove($experience);
            $this->em->flush();
        }
    }

    public function update(Experience $experience) {
        $this->em->merge($experience);
        $this->em->flush();
		return $experience;
    }

    public function findAll() {
        return $this->getRepository()->findAll();
    }
    
	public function find($id) {
        return $this->getRepository()->find($id);
    }
}
