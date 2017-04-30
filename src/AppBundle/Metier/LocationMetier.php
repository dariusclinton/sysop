<?php

namespace AppBundle\Metier;

use AppBundle\Entity\Location;
use AppBundle\Dao\LocationDao;

class LocationMetier {

    private $locationDao;

    public function __construct(LocationDao $locationDao) {
        $this->locationDao = $locationDao;
    }

    public function create(Location $location) {
        return $this->locationDao->create($location);
    }

    public function delete(Location $location) {
        $this->locationDao->delete($location);
    }

    public function update(Location $location) {
        return $this->locationDao->update($location);
    }

    public function findAll() {
        return $this->locationDao->findAll($location);
    }

    public function find($id) {
        return $this->locationDao->find($id);
    }
}