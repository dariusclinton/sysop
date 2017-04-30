<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AppBundle\Dao;
use Doctrine\ORM\EntityManager;
use AppBundle\Entity\AttributionProjet;

/**
 * Description of AttributionProjetDao
 *
 * @author fd
 */
class AttributionProjetDao {
    private $em;

    public function __construct(EntityManager $em) {
        $this->em = $em;
    }

    public function getRepository() {
        return $this->em->getRepository("AppBundle:AttributionProjet");
    }

    public function create(AttributionProjet $attributionProjet) {
        $this->em->persist($attributionProjet);
        $this->em->flush();
        return $attributionProjet;
    }

    public function delete(AttributionProjet $attributionProjet) {
        $this->em->remove($attributionProjet);
        $this->em->flush();
    }

    public function update(AttributionProjet $attributionProjet) {
        $this->em->update($attributionProjet);
        $this->em->flush();
		return $attributionProjet;
    }

    public function findAll() {
        $this->getRepository()->findAll();
    }
    
	public function find($id) {
        $this->getRepository()->find($id);
    }
}
