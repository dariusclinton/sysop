<?php

namespace AppBundle\Form;

use Doctrine\DBAL\Types\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProjetType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('libelle')
            ->add('description', null, [
                'attr' => array(
                    'rows' => 10,
                    'cols' => 40
                ),
            ])
            ->add('tarif', null, [
                'required' => false,
            ])
            ->add('dateDebut', 'date', array(
                'widget' => 'single_text',
                'html5' => false,
                'attr' => array('class' => 'js-datepicker form-control'),
            ))
            ->add('dateFin', 'date', array(
                'widget' => 'single_text',
                'html5' => false,
                'attr' => array('class' => 'js-datepicker form-control'),
            ))
//            ->add('utilisateur')
            ->add('villes', 'entity', [
                'class' => 'AppBundle:Ville',
                'choice_label' => 'nom',
                'multiple' => true,
                'required' => true,
                'attr' => array(
                    'class' => 'select2-ville form-control',
                )
            ])
            ->add('specialites', 'entity', [
                'class' => 'AppBundle:Specialite',
                'choice_label' => 'nom',
                'multiple' => true,
                'required' => true,
                'attr' => array('class' => 'select2-specialites form-control')
            ]);
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Projet'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_projet';
    }


}
