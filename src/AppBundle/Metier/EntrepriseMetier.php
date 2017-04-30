<?php

namespace AppBundle\Metier;

use AppBundle\Entity\Entreprise;
use AppBundle\Dao\EntrepriseDao;

class EntrepriseMetier {

    private $entrepriseDao;

    public function __construct(EntrepriseDao $entrepriseDao) {
        $this->entrepriseDao = $entrepriseDao;
    }

    public function create(Entreprise $entreprise) {
        return $this->entrepriseDao->create($entreprise);
    }

    public function delete(Entreprise $entreprise) {
        $this->entrepriseDao->delete($entreprise);
    }

    public function update(Entreprise $entreprise) {
        return $this->entrepriseDao->update($entreprise);
    }

    public function findAll() {
        return $this->entrepriseDao->findAll($entreprise);
    }

    public function find($id) {
        return $this->entrepriseDao->find($id);
    }
}