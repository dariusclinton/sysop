<?php


namespace AppBundle\Metier;

use AppBundle\Entity\ProgrammeLocation;
use AppBundle\Dao\ProgrammeLocationDao;

/**
 * Description of ProgrammeLocationMetier
 *
 * @author tsafack
 */
class ProgrammeLocationMetier {
    
    private $programmeLocationDao;
    
    public function __construct(ProgrammeLocationDao $programmeLocationDao) {
        $this->programmeLocationDao = $programmeLocationDao;
    }
    
    public function create(ProgrammeLocation $p) {
        return $this->programmeLocationDao->create($p);
    }
    
    public function update(ProgrammeLocation $p) {
        return $this->programmeLocationDao->update($p);
    }
    
    public function delete(ProgrammeLocation $p) {
        $this->programmeLocationDao->delete($p);
    }
    
    public function findAll() {
        return $this->programmeLocationDao->findAll();
    }
    
    public function find($id) {
        return $this->programmeLocationDao->find($id);
    }
}
