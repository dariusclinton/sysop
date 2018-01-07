<?php

namespace UserBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;


class ProfileEntrepriseFormType extends AbstractType {
  
  public function buildForm(FormBuilderInterface $builder, array $options) {
  }
  
  public function getParent() {
    return 'FOS\UserBundle\Form\Type\ProfileFormType';
  }
  
  public function getBlockPrefix()
  {
      return 'entreprise_profile';
  }

    // For Symfony 2.x
    public function getName()
    {
        return $this->getBlockPrefix();
    }
}