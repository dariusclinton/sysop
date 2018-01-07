<?php

namespace AppBundle\Admin\GestionInfoTravailleur;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use AppBundle\Entity\Travailleur;

class InfosTravailleurAdmin extends AbstractAdmin
{


    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('travailleur', EntityType::class, array(
                'class' => Travailleur::class,
                'choice_label' => 'username',
            ));
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('travailleur');
            
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('travailleur', null, array(
                'associated_property' => 'username'
            ))
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
            ->addIdentifier('travailleur', null, array(
                'associated_property' => 'username'
            ));
    }



    
}