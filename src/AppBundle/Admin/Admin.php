<?php

namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class Admin extends AbstractAdmin
{

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('email', 'email')
            ->add('username', 'text')
            ->add('password', 'password');
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
            ->addIdentifier('enabled');
    }
}