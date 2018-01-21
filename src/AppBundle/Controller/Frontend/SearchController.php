<?php

namespace AppBundle\Controller\Frontend;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;


class SearchController extends Controller
{


    /**
     * @Route("/projet/search", name="app_rechercher_projet")
     * @Method("GET")
     */
    public function searchProjetAction(Request $request)
    {

          $this->metier = $this->get("app.projet.metier");
          $metier_utilisateur = $this->get("app.utilisateur.metier");

          $parameters = array(
            'projets' => $this->metier->findByKeyword($request->query->get('keyword'))
          );

           $result = $this->metier->findByKeyword(
            $request->query->get('keyword'),
            ($request->query->get('utilisateur') != 'utilisateur') ? $request->query->get('utilisateur') : null
            );

            $parameters = array(
                'projets' => $result,
                'number' => count($result),
                'utilisateurs' => $metier_utilisateur->findAll()
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
        $metier_specialite = $this->get("app.specialite.metier");

        $session = $request->getSession();

        $keyword = $request->query->get('keyword');
        $keyword = is_null($keyword) ? $session->get('keyword') : $keyword;

        $specialite = ($request->query->get('specialite') != 'specialite') ? $request->query->get('specialite') : null;
//        $specialite = is_null($specialite) ? $session->get('specialite') : $specialite;

        $pays = ($request->query->get('pays') != 'pays') ? $request->query->get('pays') : null;
//        $pays = is_null($pays) ? $session->get('pays') : $pays;

        $ville = ($request->query->get('ville') != 'ville') ? $request->query->get('ville') : null;
//        $ville = is_null($ville) ? $session->get('ville') : $ville;

        if ($keyword != $session->get('keyword'))
            $session->set('keyword', $keyword);

//        if ($specialite != $session->get('specialite'))
//            $session->set('specialite', $specialite);

//        if ($pays != $session->get('pays'))
//            $session->set('pays', $pays);
//
//        if ($ville != $session->get('ville'))
//            $session->set('ville', $ville);

        $result = $this->metier->findByKeyword(
            $session->get('keyword'),
            $pays,
            $ville,
            $specialite
        );

        $parameters = array(
            'travailleurs' => $result,
            'number' => count($result),
            'pays' => $metier_pays->findAll(),
            'specialites' => $metier_specialite->findAll()
        );

        return $this->render(
            'AppBundle:Search:search_travailleur.html.twig', $parameters);
    }

    /**
     * @Route("/pays/{pays}/villes", options = { "expose" = true }, name="getVilleByPays")
     */
    public function getVillesByPaysAction($pays)
    {
        $metier_pays = $this->get("app.ville.metier");

        $villes = $metier_pays->getVillesByPays($pays);

        return new JsonResponse($villes);
    }
}
