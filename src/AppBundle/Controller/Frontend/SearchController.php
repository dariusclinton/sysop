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

          $this->metier = $this->get("app.projet.metier");

          $parameters = array(
            'projets' => $this->metier->findByKeyword($request->query->get('keyword'))
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
        $metier_pays = $this->get("app.pays.metier");

        $result = $this->metier->findByKeyword(
            $request->query->get('keyword'),
            ($request->query->get('pays') != 'pays') ? $request->query->get('pays') : null,
            ($request->query->get('ville') != 'ville') ? $request->query->get('ville') : null
        );

        $parameters = array(
            'travailleurs' => $result,
            'number' => count($result),
            'pays' => $metier_pays->findAll()
        );

        return $this->render(
            'AppBundle:Search:search_travailleur.html.twig', $parameters);
    }
}
