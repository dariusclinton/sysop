<?php

namespace AppBundle\Admin\GestionUtilisateur;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class EntrepriseAdmin extends AbstractAdmin
{

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('email', 'email')
            ->add('username', 'text')
            ->add('password', 'password')
            ->add('lattitude', 'text', array(
                'required' => false
            ))
            ->add('longitude', 'text' , array(
                'required' => false
            ));
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('email')
            ->add('username')
            ->add('enabled');
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('email')
            ->addIdentifier('username')
            ->addIdentifier('lattitude')
            ->addIdentifier('longitude')
            ->add('enabled', null, array(
                'editable' => true
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
            ->addIdentifier('email')
            ->addIdentifier('username')
            ->addIdentifier('enabled')
            ->addIdentifier('lattitude')
            ->addIdentifier('longitude');
    }
}