<?php

namespace AppBundle\Metier;

use AppBundle\Entity\DemandeService;
use AppBundle\Dao\DemandeServiceDao;

class DemandeServiceMetier {

    private $demandeServiceDao;

    public function __construct(DemandeServiceDao $demandeServiceDao) {
        $this->demandeServiceDao = $demandeServiceDao;
    }

    public function create(DemandeService $demandeService) {
        return $this->demandeServiceDao->create($demandeService);
    }

    public function delete(DemandeService $demandeService) {
        $this->demandeServiceDao->delete($demandeService);
    }

    public function update(DemandeService $demandeService) {
        return $this->demandeServiceDao->update($demandeService);
    }

    public function findAll() {
        return $this->demandeServiceDao->findAll($demandeService);
    }

    public function find($id) {
        return $this->demandeServiceDao->find($id);
    }
}