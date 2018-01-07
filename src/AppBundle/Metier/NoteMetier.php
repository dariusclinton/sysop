<?php

namespace AppBundle\Metier;

use AppBundle\Entity\Note;
use Doctrine\ORM\EntityManager;

/**
 * Description of NoteMetier
 *
 * @author tsafack
 */
class NoteMetier {

    private $em;
    
    public function __construct(EntityManager $em) {
        $this->em = $em;
    }
    
    public function create(Note $note) {
        $this->em->persist($note);
        $this->em->flush();
    }
    
    public function update(Note $note) {
        $this->em->merge($note);
        $this->em->flush();
    }
    
    public function delete($id) {
        $note = $this->getRepository()->find($id);
        if ($note) {
            $this->em->remove($note);
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
        return $this->em->getRepository("AppBundle:Note");
    }
}
