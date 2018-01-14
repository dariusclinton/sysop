<?php 


namespace AppBundle\Controller\Frontend;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


class ProjetController extends Controller
{

	 /**
     * @Route("/projet/create", name="app_deposer_projet")
     */
    public function deposerProjetAction(Request $request)
    {


    	$parameters = array(
    		'form' => null
    	);

    	return $this->render(
            'AppBundle:Projet:deposer.html.twig', $parameters);
    }

}