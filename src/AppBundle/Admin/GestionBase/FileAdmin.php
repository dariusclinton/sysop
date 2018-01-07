<?php

namespace AppBundle\Admin\GestionBase;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class FileAdmin extends AbstractAdmin
{

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('file', 'file', array('required' => true));
    }

    public function prePersist($file) {
        $this->saveFile($file);
    }

    public function preUpdate($file) {
        $this->saveFile($file);
    }

    public function saveFile($file) {
        $basepath = $this->getRequest()->getBasePath();
        $file->upload($basepath);
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('filename');
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('filename')
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
            ->addIdentifier('filename');
    }
}