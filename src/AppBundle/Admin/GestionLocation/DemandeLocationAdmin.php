<?php

namespace AppBundle\Admin\GestionLocation;

use AppBundle\Entity\ProgrammeLocation;
use UserBundle\Entity\Utilisateur;
use Doctrine\ORM\EntityRepository;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\CoreBundle\Form\Type\BooleanType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class DemandeLocationAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->tab('Demande Location', array('class' => 'row'))
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
                    ->add('programmeLocation', 'sonata_type_model', array(
                        'class' => ProgrammeLocation::class,
                        'multiple' => false,
                    ))
                ->end()
                ->with(null, array('class' => 'col-md-6'))
                    ->add('valide', BooleanType::class, array(
                        'required' => true,
                    ))
                    ->add('description', TextareaType::class, array(
                        'required' => false,
                        'attr' => array(
                            'rows' => 10
                        ),
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
            ->add('programmeLocation')
            ->add('description');
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('utilisateur', null, array(
                'associated_property' => 'username'
            ))
            ->addIdentifier('programmeLocation')
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
            ->addIdentifier('programmeLocation')
            ->addIdentifier('description');
    }

    public function toString($object)
    {
        return $object instanceof \AppBundle\Entity\DemandeLocation
            ? $object->getUtilisateur()->getUsername() .' | '. $object->getProgrammeLocation() .' | '. $object->getDate()->format('Y-M-d')
            : 'Project';
    }
}