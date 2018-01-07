<?php

namespace AppBundle\Admin\GestionService;

use AppBundle\Entity\Projet;
use AppBundle\Entity\Travailleur;
use AppBundle\Entity\Utilisateur;
use Doctrine\ORM\EntityRepository;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\CoreBundle\Form\Type\BooleanType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class SolliciterAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->tab('Solliciter un travailleur', array('class' => 'row'))
                ->with('Général', array('class' => 'col-md-6'))
                    ->add('utilisateur', EntityType::class, array(
                        'class' => Utilisateur::class,
                        'multiple' => false,
                        'query_builder' => function (EntityRepository $er) {
                            return $er->createQueryBuilder('u')
                                ->orderBy('u.username', 'ASC');
                        },
                        'choice_label' => 'username',
                    ))
                    ->add('travailleur', 'sonata_type_model', array(
                        'class' => Travailleur::class,
                        'multiple' => false,
                        'property' => 'username',
                    ))
                ->end()
                ->with(null, array('class' => 'col-md-6'))
                    ->add('valide', BooleanType::class, array(
                        'required' => true,
                    ))
                ->end()
            ->end()
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('date')
            ->add('valide')
            ->add('utilisateur')
            ->add('travailleur');
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('utilisateur', null, array(
                'associated_property' => 'username'
            ))
            ->addIdentifier('travailleur', null, array(
                'associated_property' => 'username'
            ))
            ->addIdentifier('date')
            ->addIdentifier('valide', null, array(
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
            ->addIdentifier('date')
            ->addIdentifier('valide')
            ->addIdentifier('utilisateur')
            ->addIdentifier('travailleur');
    }

    public function toString($object)
    {
        return $object instanceof \AppBundle\Entity\Solliciter
            ? $object->getUtilisateur()->getUsername() .' | '. $object->getTravailleur()->getUsername() .' | '. $object->getDate()->format('Y-M-d')
            : 'Project';
    }
}