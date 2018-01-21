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
                'required' => false,
            ])
            ->add('tarif', null, [
                'required' => false,
            ])
            ->add('dateDebut')
            ->add('dateFin')
//            ->add('utilisateur')
            ->add('villes', 'entity', [
                'class' => 'AppBundle:Ville',
                'choice_label' => 'nom',
                'multiple' => true,
                'required' => true,
            ])
            ->add('specialites', 'entity', [
                'class' => 'AppBundle:Specialite',
                'choice_label' => 'nom',
                'multiple' => true,
                'required' => true,
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
