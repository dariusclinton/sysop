<?php 


namespace AppBundle\Controller\Frontend;

use AppBundle\Metier\TravailleurMetier;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


class TravailleurController extends Controller
{
    private $metier;
    /**
     * @Route("/workers/search", name="app_rechercher_tavailleur")
     * @Method("GET")
     */
    public function searchTavailleurAction(Request $request)
    {
        $this->metier = $this->get("app.travailleur.metier");

    	$parameters = array(
    		'travailleurs' => $this->metier->findByKeyword($request->query->get('keyword'))
    	);

    	return $this->render('AppBundle:Travailleur:rechercher.html.twig', $parameters);
    }
}