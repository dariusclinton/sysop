<?php
/**
 * Created by PhpStorm.
 * User: tsafack
 * Date: 03/04/17
 * Time: 04:04
 */

namespace AppBundle\Controller\API;


use AppBundle\Form\DemandeLocationType;
use FOS\RestBundle\View\View;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\DemandeLocation;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use FOS\RestBundle\Controller\Annotations as Rest;

class DemandeLocationController extends Controller
{
    private $metier;

    /**
     * @Rest\View()
     * @Rest\Get("/demandeLocation")
     */
    public function getdemandeLocationsAction(Request $request) {
        $this->metier = $this->get("app.demandelocation.metier");

        $demandeLocation = $this->metier->findAll();

        return $demandeLocation;
    }

    /**
     * @Rest\View()
     * @Rest\Get("/demandeLocation/{id}")
     */
    public function getdemandeLocationAction(Request $request) {
        $this->metier = $this->get("app.demandelocation.metier");

        $id = $request->get("id");
        $demandeLocation = $this->metier->viewDemandeLocation($id);

        if (!$demandeLocation) {
            return View::create(['message' => 'Place not found'], Response::HTTP_NOT_FOUND);
        }

        return $demandeLocation;
    }

    /**
     * @Rest\View(statusCode=Response::HTTP_CREATED)
     * @Rest\Post("/demandeLocation")
     */
    public function postDemandeLocationsAction(Request $request) {
        $this->metier = $this->get("app.demandelocation.metier");
        $demandeLocation = new DemandeLocation();
        $form = $this->createForm(DemandeLocationType::class, $demandeLocation);
        $form->submit($request->request->all()); // validation des donnees

        if ($form->isValid()) {
            $this->metier->create($demandeLocation);
            return $demandeLocation;
        } else {
            return $form;
        }
    }

    /**
     * @Rest\View(statusCode=Response::HTTP_NO_CONTENT)
     * @Rest\Delete("/demandeLocation/{id}")
     */
    public function removeDemandeLocationAction(DemandeLocation $id) {
        $this->metier = $this->get("app.demandelocation.metier");
        $this->metier->delete($id);
    }

    /**
     * @Rest\View()
     * @Rest\Patch("/demandeLocation/{id}")
     */
    public function patchDemandeLocationAction(Request $request) {
        return $this->update($request, false);
    }

    /**
     * @Rest\View()
     * @Rest\Put("/demandeLocation/{id}")
     */
    public function putDemandeLocationAction(Request $request) {
        return $this->update($request, true);
    }

    private function update(Request $request, $clearMissing) {
        $this->metier = $this->get("app.demandelocation.metier");
        $demandeLocation = $this->metier->find($request->get("id"));

        if (empty($demandeLocation)) {
            return View::create(['message' => 'Place not found'], Response::HTTP_NOT_FOUND);
        }

        $form = $this->createForm(DemandeLocationType::class, $demandeLocation);
        $form->submit($request->request->all(), $clearMissing);

        if ($form->isValid()) {
            return $this->metier->update($demandeLocation);
        }

        return $form;
    }
}