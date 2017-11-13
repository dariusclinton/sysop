<?php

namespace AppBundle\Controller\Frontend;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class RegistrationController extends Controller
{

    // /**
    //  * @Route("/register/admin", name="admin_registration")
    //  */
    // public function registerAdminAction()
    // {
    //     return $this->container
    //                 ->get('pugx_multi_user.registration_manager')
    //                 ->register('AppBundle\Entity\Admin');
    // }

    /**
     * @Route("/register/entreprise", name="entreprise_registration")
     */
    public function registerEntrepriseAction()
    {
        return $this->container
                    ->get('pugx_multi_user.registration_manager')
                    ->register('AppBundle\Entity\Entreprise');
    }

    /**
     * @Route("/register/travailleur", name="travailleur_registration")
     */
    public function registerTravailleurAction()
    {
        return $this->container
                    ->get('pugx_multi_user.registration_manager')
                    ->register('AppBundle\Entity\Travailleur');
    }
}
