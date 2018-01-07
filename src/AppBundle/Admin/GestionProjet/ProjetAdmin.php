<?php

namespace AppBundle\Admin\GestionProjet;

use UserBundle\Entity\Utilisateur;
use AppBundle\Entity\Ville;
use Doctrine\ORM\EntityRepository;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class ProjetAdmin extends AbstractAdmin
{

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            //->tab('Create New')
            ->with(null, array('class' => 'row'))
                ->with('Content', array('class' => 'col-md-4'))
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

                ->with('Choix des villes du projet', array('class' => 'col-md-8'))
                    ->add('villes', EntityType::class, array(
                        'class' => Ville::class,
                        'multiple' => true,
                        'required' => false,
                        'attr' => array(
                            'placeholder' => 'Tapez le nom de la ville.. Ex: Douala'
                        ),
                        'query_builder' => function (EntityRepository $er) {
                            return $er->createQueryBuilder('v')
                                ->orderBy('v.nom', 'ASC');
                        },
                        'choice_label' => 'nom',
                    ))
                ->end()
            ->end()

            ->with(null, array('class' => 'row'))
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

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('utilisateur')
            ->add('libelle')
            ->add('description');
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('libelle')
            ->addIdentifier('utilisateur')
            ->addIdentifier('villes', null, array(
                'associated_property' => 'nom'
            ))
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
            ->addIdentifier('villes', null, array(
                'associated_property' => 'nom'
            ));
    }

    public function toString($object)
    {
        return $object instanceof \AppBundle\Entity\Projet
            ? $object->getLibelle()
            : 'Project';
    }
}