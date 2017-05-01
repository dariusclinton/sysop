<?php
/**
 * Created by PhpStorm.
 * User: tsafack
 * Date: 03/04/17
 * Time: 04:04
 */

namespace AppBundle\Controller\API;


use AppBundle\Form\AttributionProjetType;
use FOS\RestBundle\View\View;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\AttributionProjet;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use FOS\RestBundle\Controller\Annotations as Rest;

class AttributionProjetController extends Controller
{
    private $metier;

    /**
     * @Rest\View()
     * @Rest\Get("/attributionProjet")
     */
    public function getattributionProjetsAction(Request $request) {
        $this->metier = $this->get("app.attributionprojet.metier");

        $attributionProjet = $this->metier->findAll();

        return $attributionProjet;
    }

    /**
     * @Rest\View()
     * @Rest\Get("/attributionProjet/{id}")
     */
    public function getattributionProjetAction(Request $request) {
        $this->metier = $this->get("app.attributionprojet.metier");

        $id = $request->get("id");
        $attributionProjet = $this->metier->viewAttributionProjet($id);

        if (!$attributionProjet) {
            return View::create(['message' => 'Place not found'], Response::HTTP_NOT_FOUND);
        }

        return $attributionProjet;
    }

    /**
     * @Rest\View(statusCode=Response::HTTP_CREATED)
     * @Rest\Post("/attributionProjet")
     */
    public function postAttributionProjetsAction(Request $request) {
        $this->metier = $this->get("app.attributionprojet.metier");
        $attributionProjet = new AttributionProjet();
        $form = $this->createForm(AttributionProjetType::class, $attributionProjet);
        $form->submit($request->request->all()); // validation des donnees

        if ($form->isValid()) {
            $this->metier->create($attributionProjet);
            return $attributionProjet;
        } else {
            return $form;
        }
    }

    /**
     * @Rest\View(statusCode=Response::HTTP_NO_CONTENT)
     * @Rest\Delete("/attributionProjet/{id}")
     */
    public function removeAttributionProjetAction(AttributionProjet $id) {
        $this->metier = $this->get("app.attributionprojet.metier");
        $this->metier->delete($id);
    }

    /**
     * @Rest\View()
     * @Rest\Patch("/attributionProjet/{id}")
     */
    public function patchAttributionProjetAction(Request $request) {
        return $this->update($request, false);
    }

    /**
     * @Rest\View()
     * @Rest\Put("/attributionProjet/{id}")
     */
    public function putAttributionProjetAction(Request $request) {
        return $this->update($request, true);
    }

    private function update(Request $request, $clearMissing) {
        $this->metier = $this->get("app.attributionprojet.metier");
        $attributionProjet = $this->metier->find($request->get("id"));

        if (empty($attributionProjet)) {
            return View::create(['message' => 'Place not found'], Response::HTTP_NOT_FOUND);
        }

        $form = $this->createForm(AttributionProjetType::class, $attributionProjet);
        $form->submit($request->request->all(), $clearMissing);

        if ($form->isValid()) {
            return $this->metier->update($attributionProjet);
        }

        return $form;
    }
}