<?php

namespace AppBundle\Controller\Frontend;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class SearchController extends Controller
{
    
    
    /**
     * @Route("/projet/search", name="app_rechercher_projet")
     * @Method("GET")
     */
    public function searchProjetAction(Request $request)
    {


        $parameters = array(
            'projets' => array()
        );

        return $this->render(
            'AppBundle:Search:search_projet.html.twig', $parameters);
    }
    
    
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

        return $this->render(
            'AppBundle:Search:search_travailleur.html.twig', $parameters);
    }
}
