<?php

namespace AppBundle\Metier;

use AppBundle\Entity\Note;
use AppBundle\Dao\NoteDao;

/**
 * Description of NoteMetier
 *
 * @author tsafack
 */
class NoteMetier {

    private $noteDao;
    
    public function __construct(NoteDao $noteDao) {
        $this->noteDao = $noteDao;
    }
    
    public function create(Note $note) {
        return $this->noteDao->create($note);
    }
    
    public function update(Note $note) {
        return $this->noteDao->update($note);
    }
    
    public function delete(Note $note) {
        $this->noteDao->delete($note);
    }
    
    public function findAll() {
        return $this->noteDao->findAll();
    }
    
    public function find($id) {
        return $this->noteDao->find($id);
    }
}
