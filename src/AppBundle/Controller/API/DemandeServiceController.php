<?php
/**
 * Created by PhpStorm.
 * User: tsafack
 * Date: 03/04/17
 * Time: 04:04
 */

namespace AppBundle\Controller\API;


use AppBundle\Form\DemandeServiceType;
use FOS\RestBundle\View\View;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\DemandeService;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use FOS\RestBundle\Controller\Annotations as Rest;

class DemandeServiceController extends Controller
{
    private $metier;

    /**
     * @Rest\View()
     * @Rest\Get("/demandeService")
     */
    public function getdemandeServicesAction(Request $request) {
        $this->metier = $this->get("app.demandeservice.metier");

        $demandeService = $this->metier->findAll();

        return $demandeService;
    }

    /**
     * @Rest\View()
     * @Rest\Get("/demandeService/{id}")
     */
    public function getdemandeServiceAction(Request $request) {
        $this->metier = $this->get("app.demandeParticipation.metier");

        $id = $request->get("id");
        $demandeService = $this->metier->viewDemandeService($id);

        if (!$demandeService) {
            return View::create(['message' => 'Place not found'], Response::HTTP_NOT_FOUND);
        }

        return $demandeService;
    }

    /**
     * @Rest\View(statusCode=Response::HTTP_CREATED)
     * @Rest\Post("/demandeService")
     */
    public function postDemandeServicesAction(Request $request) {
        $this->metier = $this->get("app.demandeParticipation.metier");
        $demandeService = new DemandeService();
        $form = $this->createForm(DemandeServiceType::class, $demandeService);
        $form->submit($request->request->all()); // validation des donnees

        if ($form->isValid()) {
            $this->metier->create($demandeService);
            return $demandeService;
        } else {
            return $form;
        }
    }

    /**
     * @Rest\View(statusCode=Response::HTTP_NO_CONTENT)
     * @Rest\Delete("/demandeService/{id}")
     */
    public function removeDemandeServiceAction(DemandeService $id) {
        $this->metier = $this->get("app.demandeParticipation.metier");
        $this->metier->delete($id);
    }

    /**
     * @Rest\View()
     * @Rest\Patch("/demandeService/{id}")
     */
    public function patchDemandeServiceAction(Request $request) {
        return $this->update($request, false);
    }

    /**
     * @Rest\View()
     * @Rest\Put("/demandeService/{id}")
     */
    public function putDemandeServiceAction(Request $request) {
        return $this->update($request, true);
    }

    private function update(Request $request, $clearMissing) {
        $this->metier = $this->get("app.demandeParticipation.metier");
        $demandeService = $this->metier->find($request->get("id"));

        if (empty($demandeService)) {
            return View::create(['message' => 'Place not found'], Response::HTTP_NOT_FOUND);
        }

        $form = $this->createForm(DemandeServiceType::class, $demandeService);
        $form->submit($request->request->all(), $clearMissing);

        if ($form->isValid()) {
            return $this->metier->update($demandeService);
        }

        return $form;
    }
}