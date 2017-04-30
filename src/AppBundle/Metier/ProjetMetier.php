<?php


namespace AppBundle\Metier;

use AppBundle\Entity\Projet;
use AppBundle\Dao\ProjetDao;

/**
 * Description of ProjetMetier
 *
 * @author tsafack
 */
class ProjetMetier {
    
    private $projetDao;
    
    public function __construct(ProjetDao $projetDao) {
        $this->projetDao = $projetDao;
    }
    
    public function create(Projet $projet) {
        return $this->projetDao->create($projet);
    }
    
    public function update(Projet $projet) {
        return $this->projetDao->update($projet);
    }
    
    public function delete(Projet $projet) {
        $this->projetDao->delete($projet);
    }
    
    public function findAll() {
        return $this->projetDao->findAll();
    }
    
    public function find($id) {
        return $this->projetDao->find($id);
    }
}
