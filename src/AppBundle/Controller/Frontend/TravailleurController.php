<?php 


namespace AppBundle\Controller\Frontend;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


class TravailleurController extends Controller
{
    /**
     * @Route("/workers/search", name="app_rechercher_tavailleur")
     * @Method("GET")
     */
    public function searchTavailleurAction(Request $request)
    {


    	$parameters = array(
    		'form' => null
    	);

    	return $this->render('AppBundle:Travailleur:rechercher.html.twig', $parameters);
    }
}