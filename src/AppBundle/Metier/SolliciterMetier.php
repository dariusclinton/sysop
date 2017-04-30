<?php


namespace AppBundle\Metier;

use AppBundle\Entity\Solliciter;
use AppBundle\Dao\SolliciterDao;

/**
 * Description of solliciterMetier
 *
 * @author tsafack
 */
class SolliciterMetier {
    
    private $solliciterDao;
    
    public function __construct(SolliciterDao $solliciterDao) {
        $this->solliciterDao = $solliciterDao;
    }
    
    public function create(Solliciter $solliciter) {
        return $this->solliciterDao->create($solliciter);
    }
    
    public function update(Solliciter $solliciter) {
        return $this->solliciterDao->update($solliciter);
    }
    
    public function delete(Solliciter $solliciter) {
        $this->solliciterDao->delete($solliciter);
    }
    
    public function findAll() {
        return $this->solliciterDao->findAll();
    }
    
    public function find($id) {
        return $this->solliciterDao->find($id);
    }
}
