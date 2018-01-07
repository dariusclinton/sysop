<?php

namespace AppBundle\Admin\GestionProjet;

use AppBundle\Entity\Projet;
use AppBundle\Entity\Travailleur;
use Doctrine\ORM\EntityRepository;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\CoreBundle\Form\Type\BooleanType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class DemandeParticipationAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->tab('Demande Participation', array('class' => 'row'))
                ->with('Général', array('class' => 'col-md-6'))
                    ->add('projet', 'sonata_type_model', array(
                        'class' => Projet::class,
                        'multiple' => false,
                        'property' => 'libelle',
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
                    ->add('motivation', TextareaType::class, array(
                        'required' => true,
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
            ->addIdentifier('projet')
            ->addIdentifier('travailleur')
            ->addIdentifier('motivation');
    }

    public function toString($object)
    {
        return $object instanceof \AppBundle\Entity\DemandeParticipation
            ? $object->getProjet()->getLibelle() .' | '. $object->getTravailleur()->getUsername() .' | '. $object->getDate()->format('Y-M-d')
            : 'Project';
    }
}