<?php 


namespace AppBundle\Controller\Frontend;

use AppBundle\Metier\TravailleurMetier;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use UserBundle\Entity\Travailleur;


class TravailleurController extends Controller
{
    private $metier;
    

    /** 
     * @Route("/public/{slug}", name="app_travailleur_public_profile")
     * @Method("GET")
     * @ParamConverter("travailleur", options={"maping": {"slug": "slug"}})
     */
   	public function profilePublicTravailleurAction(Travailleur $travailleur, 
   		Request $request)
   	{
   		$parameters = array(
   			'travailleur' => null
   		);

   		return $this->render(
   			'AppBundle:Travailleur:travailleur_public_profile.html.twig', 
   			$parameters
   		);
   	}
}