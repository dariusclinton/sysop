<?php

namespace AppBundle\Admin\GestionProjet;

use AppBundle\Entity\Projet;
use AppBundle\Entity\Travailleur;
use Doctrine\ORM\EntityRepository;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class AttributionProjetAdmin extends AbstractAdmin
{

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->tab('Attribuer un projet aux travailleurs', array('class' => 'row'))
                ->with('Projet', array('class' => 'col-md-6'))
                    ->add('projet', 'sonata_type_model', array(
                        'class' => Projet::class,
                        'multiple' => false,
                        /*'query_builder' => function (EntityRepository $er) {
                            return $er->createQueryBuilder('p')
                                ->orderBy('p.libelle', 'ASC');
                        },*/
                        'property' => 'libelle',
                    ))
                ->end()

                ->with('Travailleurs', array('class' => 'col-md-6'))
                    ->add('travailleur', 'sonata_type_model', array(
                        'class' => Travailleur::class,
                        'multiple' => false,
                        'property' => 'username',
                    ))
                    ->end()
            ->end()
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('date')
            ->add('projet')
            ->add('travailleur');
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('projet', null, array(
                'associated_property' => 'libelle'
            ))
            ->addIdentifier('travailleur', null, array(
                'associated_property' => 'username'
            ))
            ->addIdentifier('date')
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
            ->addIdentifier('date')
            ->addIdentifier('projet')
            ->addIdentifier('travailleur');
    }

    public function toString($object)
    {
        return $object instanceof \AppBundle\Entity\AttributionProjet
            ? $object->getProjet()->getLibelle() .' | '. $object->getTravailleur()->getUsername() .' | '. $object->getDate()->format('Y-M-d')
            : 'Project';
    }
}