<?php
/**
 * Created by PhpStorm.
 * User: tsafack
 * Date: 03/04/17
 * Time: 04:04
 */

namespace AppBundle\Controller\API;


use AppBundle\Form\TravailleurType;
use FOS\RestBundle\View\View;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use UserBundle\Entity\Travailleur;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use FOS\RestBundle\Controller\Annotations as Rest;

class TravailleurController extends Controller
{
    private $metier;

    /**
     * @Rest\View()
     * @Rest\Get("/travailleur")
     */
    public function gettravailleursAction(Request $request) {
        $this->metier = $this->get("app.travailleur.metier");

        $travailleur = $this->metier->findAll();

        return $travailleur;
    }

    /**
     * @Rest\View()
     * @Rest\Get("/travailleur/{id}")
     */
    public function gettravailleurAction(Request $request) {
        $this->metier = $this->get("app.travailleur.metier");

        $id = $request->get("id");
        $travailleur = $this->metier->viewTravailleur($id);

        if (!$travailleur) {
            return View::create(['message' => 'Place not found'], Response::HTTP_NOT_FOUND);
        }

        return $travailleur;
    }

    /**
     * @Rest\View(statusCode=Response::HTTP_CREATED)
     * @Rest\Post("/travailleur")
     */
    public function postTravailleursAction(Request $request) {
        $this->metier = $this->get("app.travailleur.metier");
        $travailleur = new Travailleur();
        $form = $this->createForm(TravailleurType::class, $travailleur);
        $form->submit($request->request->all()); // validation des donnees

        if ($form->isValid()) {
            $this->metier->create($travailleur);
            return $travailleur;
        } else {
            return $form;
        }
    }

    /**
     * @Rest\View(statusCode=Response::HTTP_NO_CONTENT)
     * @Rest\Delete("/travailleur/{id}")
     */
    public function removeTravailleurAction(Travailleur $id) {
        $this->metier = $this->get("app.travailleur.metier");
        $this->metier->delete($id);
    }

    /**
     * @Rest\View()
     * @Rest\Patch("/travailleur/{id}")
     */
    public function patchTravailleurAction(Request $request) {
        return $this->update($request, false);
    }

    /**
     * @Rest\View()
     * @Rest\Put("/travailleur/{id}")
     */
    public function putTravailleurAction(Request $request) {
        return $this->update($request, true);
    }

    private function update(Request $request, $clearMissing) {
        $this->metier = $this->get("app.travailleur.metier");
        $travailleur = $this->metier->find($request->get("id"));

        if (empty($travailleur)) {
            return View::create(['message' => 'Place not found'], Response::HTTP_NOT_FOUND);
        }

        $form = $this->createForm(TravailleurType::class, $travailleur);
        $form->submit($request->request->all(), $clearMissing);

        if ($form->isValid()) {
            return $this->metier->update($travailleur);
        }

        return $form;
    }
}