<?php


namespace AppBundle\Metier;

use AppBundle\Entity\Travailleur;
use AppBundle\Dao\TravailleurDao;

/**
 * Description of travailleurMetier
 *
 * @author tsafack
 */
class travailleurMetier {
    
    private $travailleurDao;
    
    public function __construct(TravailleurDao $travailleurDao) {
        $this->travailleurDao = $travailleurDao;
    }
    
    public function create(Travailleur $travailleur) {
        return $this->travailleurDao->create($travailleur);
    }
    
    public function update(Travailleur $travailleur) {
        return $this->travailleurDao->update($travailleur);
    }
    
    public function delete(Travailleur $travailleur) {
        $this->travailleurDao->delete($travailleur);
    }
    
    public function findAll() {
        return $this->travailleurDao->findAll();
    }
    
    public function find($id) {
        return $this->travailleurDao->find($id);
    }
}
