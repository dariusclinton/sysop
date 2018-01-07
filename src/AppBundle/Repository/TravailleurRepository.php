<?php

namespace AppBundle\Repository;

/**
 * TravailleurRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class TravailleurRepository extends \Doctrine\ORM\EntityRepository
{

    public function findByKeyword($keyword)
    {
        return $this->getEntityManager()->createQuery('
            SELECT t
            FROM AppBundle:Travailleur t
            WHERE t.username LIKE :keyword
        ')->setParameters([
            'keyword' => '%' . $keyword . '%',
        ])->getResult();
    }
}
