<?php

namespace AppBundle\Metier;

use AppBundle\Entity\DemandeLocation;
use AppBundle\Dao\DemandeLocationDao;

class DemandeLocationMetier {

    private $demandeLocationDao;

    public function __construct(DemandeLocationDao $demandeLocationDao) {
        $this->demandeLocationDao = $demandeLocationDao;
    }

    public function create(DemandeLocation $demandeLocation) {
        return $this->demandeLocationDao->create($demandeLocation);
    }

    public function delete(DemandeLocation $demandeLocation) {
        $this->demandeLocationDao->delete($demandeLocation);
    }

    public function update(DemandeLocation $demandeLocation) {
        return $this->demandeLocationDao->update($demandeLocation);
    }

    public function findAll() {
        return $this->demandeLocationDao->findAll($demandeLocation);
    }

    public function find($id) {
        return $this->demandeLocationDao->find($id);
    }
}