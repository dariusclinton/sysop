<?php

namespace AppBundle\Admin\GestionService;

use UserBundle\Entity\Utilisateur;
use AppBundle\Form\FileType;
use Doctrine\ORM\EntityRepository;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class DemandeServiceAdmin extends AbstractAdmin
{

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            //->tab('Create New')
            ->with('Général Info', array('class' => 'col-md-4'))
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
            ->end()

            ->with('--', array('class' => 'col-md-8'))
                ->add('fichier', 'sonata_type_admin', [
                    'delete' => false
                ])
                ->add('description', 'textarea', array(
                    'required' => false,
                    'attr' => array(
                        'rows' => 10
                    ),
                ))
            ->end()
            //->end()
        ;
    }

    public function prePersist($service)
    {
        $this->manageEmbeddedFileAdmins($service);
    }

    public function preUpdate($service)
    {
        $this->manageEmbeddedFileAdmins($service);
    }

    private function manageEmbeddedFileAdmins($service)
    {
        $getter = 'getFichier';
        $setter = 'setFichier';

        $file = $service->$getter();

        if ($file) {
            if ($file->getFile()) {
                // update the Image to trigger file management
                //$file->refreshUpdated();
            } elseif (!$file->getFile() && !$file->getFilename()) {
                // prevent Sf/Sonata trying to create and persist an empty Image
                $service->$setter(null);
            }
        }
    }


    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('utilisateur')
            ->add('date')
            ->add('libelle')
            ->add('description');
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('libelle')
            ->addIdentifier('utilisateur')
            ->addIdentifier('date')
            ->addIdentifier('description')
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
            ->addIdentifier('utilisateur')
            ->addIdentifier('libelle')
            ->addIdentifier('description')
            ->addIdentifier('date');
    }

    public function toString($object)
    {
        return $object instanceof \AppBundle\Entity\DemandeService
            ? $object->getLibelle()
            : 'Project';
    }
}