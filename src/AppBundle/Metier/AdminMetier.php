<?php

namespace AppBundle\Metier;

use AppBundle\Entity\Admin;
use AppBundle\Dao\AdminDao;

class AdminMetier {

    private $adminDao;

    public function __construct(AdminDao $adminDao) {
        $this->adminDao = $adminDao;
    }

    public function create(Admin $admin) {
        return $this->adminDao->create($admin);
    }

    public function delete(Admin $admin) {
        $this->adminDao->delete($admin);
    }

    public function update(Admin $admin) {
        return $this->adminDao->update($admin);
    }

    public function findAll() {
        return $this->adminDao->findAll($admin);
    }

    public function find($id) {
        return $this->adminDao->find($id);
    }
}