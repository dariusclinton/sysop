<?php

namespace AppBundle\Metier;

use AppBundle\Entity\AttributionProjet;
use AppBundle\Dao\AttributionProjetDao;

class AttributionProjetMetier {

    private $attributionProjetDao;

    public function __construct(AttributionProjetDao $attributionProjetDao) {
        $this->attributionProjetDao = $attributionProjetDao;
    }

    public function create(AttributionProjet $attributionProjet) {
        return $this->attributionProjetDao->create($attributionProjet);
    }

    public function delete(AttributionProjet $attributionProjet) {
        $this->attributionProjetDao->delete($attributionProjet);
    }

    public function update(AttributionProjet $attributionProjet) {
        return $this->attributionProjetDao->update($attributionProjet);
    }

    public function findAll() {
        return $this->attributionProjetDao->findAll($attributionProjet);
    }

    public function find($id) {
        return $this->attributionProjetDao->find($id);
    }
}