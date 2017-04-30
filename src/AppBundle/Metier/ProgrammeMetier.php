<?php

namespace AppBundle\Metier;

use AppBundle\Entity\Programme;
use AppBundle\Dao\ProgrammeDao;

/**
 * Description of ProgrammeMetier
 *
 * @author tsafack
 */
class ProgrammeMetier {
 
    private $programmeDao;
    
    public function __construct(ProgrammeDao $programmeDao) {
        $this->programmeDao = $programmeDao;
    }
    
    public function create(Programme $programme) {
        return $this->programmeDao->create($programme);
    }
    
    public function update(Programme $programme) { 
        return $this->programmeDao->update($programme);
    }
    
    public function delete(Programme $programme) {
        $this->programmeDao->delete($programme);
    }
    
    public function findAll() {
        return $this->programmeDao->findAll();
    }
    
    public function find($id) {
        return $programmeDao->find($id);
    }
}
