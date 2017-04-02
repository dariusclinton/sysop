<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class RegistrationController extends Controller
{
    public function registerAdminAction()
    {
        return $this->container
                    ->get('pugx_multi_user.registration_manager')
                    ->register('AppBundle\Entity\Admin');
    }

    public function registerEntrepriseAction()
    {
        return $this->container
                    ->get('pugx_multi_user.registration_manager')
                    ->register('AppBundle\Entity\Entreprise');
    }

    public function registerTravailleurAction()
    {
        return $this->container
                    ->get('pugx_multi_user.registration_manager')
                    ->register('AppBundle\Entity\Travailleur');
    }
}
