<?php

namespace AppBundle\Admin\GestionLocation;

use AppBundle\Entity\Location;
use Doctrine\ORM\EntityRepository;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\CoreBundle\Form\Type\BooleanType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class ProgrammeLocationAdmin extends AbstractAdmin
{

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('location', EntityType::class, array(
                'class' => Location::class,
                'multiple' => false,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('l')
                        ->orderBy('l.libelle', 'ASC');
                },
                'choice_label' => 'libelle',
            ))
            ->add('disponible', BooleanType::class)
            ->add('jour', 'text')
            ->add('heureDebut', 'time')
            ->add('heureFin', 'time');
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('disponible')
            ->add('jour')
            ->add('heureDebut')
            ->add('heureFin')
            ->add('location');
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('location', null, array(
                'associated_property' => 'libelle'
            ))
            ->addIdentifier('disponible')
            ->addIdentifier('jour')
            ->addIdentifier('heureDebut')
            ->addIdentifier('heureFin')
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
            ->addIdentifier('location', null, array(
                'associated_property' => 'libelle'
            ))
            ->addIdentifier('disponible')
            ->addIdentifier('jour')
            ->addIdentifier('heureDebut')
            ->addIdentifier('heureFin');
    }

    public function toString($object)
    {
        return $object instanceof \AppBundle\Entity\ProgrammeLocation
            ? $object->getLocation()->getLibelle() .'|' . $object->getJour()
            : 'ProgrammeLocation';
    }
}