<?php
/**
 * Created by PhpStorm.
 * User: tsafack
 * Date: 03/04/17
 * Time: 04:04
 */

namespace AppBundle\Controller\API;


use AppBundle\Form\DemandeParticipationType;
use FOS\RestBundle\View\View;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\DemandeParticipation;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use FOS\RestBundle\Controller\Annotations as Rest;

class DemandeParticipationController extends Controller
{
    private $metier;

    /**
     * @Rest\View()
     * @Rest\Get("/demandeParticipation")
     */
    public function getdemandeParticipationsAction(Request $request) {
        $this->metier = $this->get("app.demandeParticipation.metier");

        $demandeParticipation = $this->metier->findAll();

        return $demandeParticipation;
    }

    /**
     * @Rest\View()
     * @Rest\Get("/demandeParticipation/{id}")
     */
    public function getdemandeParticipationAction(Request $request) {
        $this->metier = $this->get("app.demandeParticipation.metier");

        $id = $request->get("id");
        $demandeParticipation = $this->metier->viewDemandeParticipation($id);

        if (!$demandeParticipation) {
            return View::create(['message' => 'Place not found'], Response::HTTP_NOT_FOUND);
        }

        return $demandeParticipation;
    }

    /**
     * @Rest\View(statusCode=Response::HTTP_CREATED)
     * @Rest\Post("/demandeParticipation")
     */
    public function postDemandeParticipationsAction(Request $request) {
        $this->metier = $this->get("app.demandeParticipation.metier");
        $demandeParticipation = new DemandeParticipation();
        $form = $this->createForm(DemandeParticipationType::class, $demandeParticipation);
        $form->submit($request->request->all()); // validation des donnees

        if ($form->isValid()) {
            $this->metier->create($demandeParticipation);
            return $demandeParticipation;
        } else {
            return $form;
        }
    }

    /**
     * @Rest\View(statusCode=Response::HTTP_NO_CONTENT)
     * @Rest\Delete("/demandeParticipation/{id}")
     */
    public function removeDemandeParticipationAction(DemandeParticipation $id) {
        $this->metier = $this->get("app.demandeParticipation.metier");
        $this->metier->delete($id);
    }

    /**
     * @Rest\View()
     * @Rest\Patch("/demandeParticipation/{id}")
     */
    public function patchDemandeParticipationAction(Request $request) {
        return $this->update($request, false);
    }

    /**
     * @Rest\View()
     * @Rest\Put("/demandeParticipation/{id}")
     */
    public function putDemandeParticipationAction(Request $request) {
        return $this->update($request, true);
    }

    private function update(Request $request, $clearMissing) {
        $this->metier = $this->get("app.demandeParticipation.metier");
        $demandeParticipation = $this->metier->find($request->get("id"));

        if (empty($demandeParticipation)) {
            return View::create(['message' => 'Place not found'], Response::HTTP_NOT_FOUND);
        }

        $form = $this->createForm(DemandeParticipationType::class, $demandeParticipation);
        $form->submit($request->request->all(), $clearMissing);

        if ($form->isValid()) {
            return $this->metier->update($demandeParticipation);
        }

        return $form;
    }
}