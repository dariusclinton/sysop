<?php

namespace AppBundle\Admin\GestionBase;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use AppBundle\Entity\Travailleur;
use AppBundle\Entity\Projet;

class DemandeParticipationAdmin extends AbstractAdmin
{


    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('date')
            ->add('valide')
            ->add('motivation')
            ->add('travailleur', EntityType::class, array(
                'class' => Travailleur::class,
                'choice_label' => 'id',
            ))
            ->add('projet', EntityType::class, array(
                'class' => Projet::class,
                'choice_label' => 'libelle',
            ));
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
             ->add('date')
            ->add('valide')
            ->add('motivation');
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('date')
            ->add('valide')
            ->add('motivation')
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
             ->add('date')
            ->add('valide')
            ->add('motivation');
    }



    
}