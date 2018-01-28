<?php

namespace AppBundle\Metier;

use AppBundle\Entity\InfosTravailleur;
use Doctrine\ORM\EntityManager;

/**
 * Description of InfosTravailleurMetier
 *
 * @author tsafack
 */
class InfosTravailleurMetier {

    private $em;
    
    public function __construct(EntityManager $em) {
        $this->em = $em;
    }
    
    public function create(InfosTravailleur $it) {
        $this->em->persist($it);
        $this->em->flush();
    }
    
    public function update(InfosTravailleur $it) {
        $this->em->merge($it);
        $this->em->flush();
    }
    
    public function delete($id) {
        $it = $this->getRepository()->find($id);
        if ($it) {
            $this->em->remove($it);
            $this->em->flush();
        }
    }
    
    public function findAll() {
        return $this->getRepository()->findAll();
    }
    
    public function find($id) {
        return $this->getRepository()->find($id);
    }
    
    private function getRepository() {
        return $this->em->getRepository("AppBundle:InfosTravailleur");
    }
}
