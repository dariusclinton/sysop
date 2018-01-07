<?php

namespace AppBundle\Admin\GestionInfoTravailleur;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class ExperienceAdmin extends AbstractAdmin
{

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('description')
            ->add('dateFin')
            ->add('dateDebut');
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('description')
            ->add('dateFin')
            ->add('dateDebut');
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('description')
            ->add('dateFin')
            ->add('dateDebut')
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
            ->add('description')
            ->add('dateFin')
            ->add('dateDebut');
    }
}