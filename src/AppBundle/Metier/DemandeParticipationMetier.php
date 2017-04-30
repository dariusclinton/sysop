<?php

namespace AppBundle\Metier;

use AppBundle\Entity\DemandeParticipation;
use AppBundle\Dao\DemandeParticipationDao;

class DemandeParticipationMetier {

    private $demandeParticipationDao;

    public function __construct(DemandeParticipationDao $demandeParticipationDao) {
        $this->demandeParticipationDao = $demandeParticipationDao;
    }

    public function create(DemandeParticipation $demandeParticipation) {
        return $this->demandeParticipationDao->create($demandeParticipation);
    }

    public function delete(DemandeParticipation $demandeParticipation) {
        $this->demandeParticipationDao->delete($demandeParticipation);
    }

    public function update(DemandeParticipation $demandeParticipation) {
        return $this->demandeParticipationDao->update($demandeParticipation);
    }

    public function findAll() {
        return $this->demandeParticipationDao->findAll($demandeParticipation);
    }

    public function find($id) {
        return $this->demandeParticipationDao->find($id);
    }
}