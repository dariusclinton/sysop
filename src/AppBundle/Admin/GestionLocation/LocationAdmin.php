<?php

namespace AppBundle\Admin\GestionLocation;

use UserBundle\Entity\Utilisateur;
use Doctrine\ORM\EntityRepository;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class LocationAdmin extends AbstractAdmin
{

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('utilisateur', EntityType::class, array(
                'class' => Utilisateur::class,
                'multiple' => false,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('u')
                        ->orderBy('u.username', 'ASC');
                },
                'choice_label' => 'username',
            ))
            ->add('libelle', 'text')
            ->add('montant', 'integer');
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('utilisateur')
            ->add('libelle')
            ->add('montant');
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('libelle')
            ->addIdentifier('utilisateur')
            ->addIdentifier('montant')
            ->addIdentifier('programmesLocation')
            ->add('_action', null, array(
                'actions' => array(
                    'show' => array(),
                    'edit' => array(),
                    'delete' => array(),
                )
            ));
    }

    protected function configureShownFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('libelle')
            ->addIdentifier('utilisateur')
            ->addIdentifier('description');
    }

    public function toString($object)
    {
        return $object instanceof \AppBundle\Entity\Location
            ? $object->getLibelle()
            : 'Location';
    }
}