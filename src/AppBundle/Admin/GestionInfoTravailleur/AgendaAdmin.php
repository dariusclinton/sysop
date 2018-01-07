<?php

namespace AppBundle\Admin\GestionInfoTravailleur;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use AppBundle\Entity\Evenement;
use AppBundle\Entity\InfosTravailleur;

class AgendaAdmin extends AbstractAdmin
{


    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('evenements', EntityType::class, array(
                'class' => Evenement::class,
                'choice_label' => 'jour',
            ))
            ->add('infosTravailleur', EntityType::class, array(
                'class' => InfosTravailleur::class,
                'choice_label' => 'jour',
            ));
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('evenements')
            ->add('infosTravailleur');
            
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('evenements', null, array(
                'associated_property' => 'id'
            ))
            ->addIdentifier('infosTravailleur', null, array(
                'associated_property' => 'id'
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
           ->addIdentifier('evenements', null, array(
                'associated_property' => 'id'
            ))
            ->addIdentifier('infosTravailleur', null, array(
                'associated_property' => 'id'
            ));
    }


    
}