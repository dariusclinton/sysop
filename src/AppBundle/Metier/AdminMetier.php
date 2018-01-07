<?php

namespace AppBundle\Metier;

use UserBundle\Entity\Admin;
use Doctrine\ORM\EntityManager;

class AdminMetier {

    private $em;

    public function __construct(EntityManager $em) {
        $this->em = $em;
    }

    public function create(Admin $admin) {
        $this->em->persist($admin);
        $this->em->flush();
    }

    public function delete($id) {
        $admin = $this->getRepository()->find($id);
        if ($admin) {
            $this->remove($admin);
            $this->flush();
        }
    }

    public function update(Admin $admin) {
        $this->em->merge($admin);
        $this->em->flush();
    }

    public function findAll() {
        return $this->getRepository()->findAll();
    }

    public function find($id) {
        return $this->getRepository()->find($id);
    }
    
    private function getRepository() {
        return $this->em->getRepository("AppBundle:Admin");
    }
}