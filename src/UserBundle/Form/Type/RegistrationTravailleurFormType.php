<?php

namespace UserBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class RegistrationTravailleurFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder;
    }

    public function getParent()
    {
        return 'UserBundle\Form\Type\RegistrationType';
    }

    public function getBlockPrefix()
    {
        return 'travailleur_registration';
    }

    // For Symfony 2.x
    public function getName()
    {
        return $this->getBlockPrefix();
    }
}