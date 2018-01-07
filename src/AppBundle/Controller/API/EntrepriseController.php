<?php
/**
 * Created by PhpStorm.
 * User: tsafack
 * Date: 03/04/17
 * Time: 04:04
 */

namespace AppBundle\Controller\API;


use AppBundle\Form\EntrepriseType;
use FOS\RestBundle\View\View;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use UserBundle\Entity\Entreprise;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use FOS\RestBundle\Controller\Annotations as Rest;

class EntrepriseController extends Controller
{
    private $metier;

    /**
     * @Rest\View()
     * @Rest\Get("/entreprise")
     */
    public function getentreprisesAction(Request $request) {
        $this->metier = $this->get("app.entreprise.metier");

        $entreprise = $this->metier->findAll();

        return $entreprise;
    }

    /**
     * @Rest\View()
     * @Rest\Get("/entreprise/{id}")
     */
    public function getentrepriseAction(Request $request) {
        $this->metier = $this->get("app.entreprise.metier");

        $id = $request->get("id");
        $entreprise = $this->metier->viewEntreprise($id);

        if (!$entreprise) {
            return View::create(['message' => 'Place not found'], Response::HTTP_NOT_FOUND);
        }

        return $entreprise;
    }

    /**
     * @Rest\View(statusCode=Response::HTTP_CREATED)
     * @Rest\Post("/entreprise")
     */
    public function postEntreprisesAction(Request $request) {
        $this->metier = $this->get("app.entreprise.metier");
        $entreprise = new Entreprise();
        $form = $this->createForm(EntrepriseType::class, $entreprise);
        $form->submit($request->request->all()); // validation des donnees

        if ($form->isValid()) {
            $this->metier->create($entreprise);
            return $entreprise;
        } else {
            return $form;
        }
    }

    /**
     * @Rest\View(statusCode=Response::HTTP_NO_CONTENT)
     * @Rest\Delete("/entreprise/{id}")
     */
    public function removeEntrepriseAction(Entreprise $id) {
        $this->metier = $this->get("app.entreprise.metier");
        $this->metier->delete($id);
    }

    /**
     * @Rest\View()
     * @Rest\Patch("/entreprise/{id}")
     */
    public function patchEntrepriseAction(Request $request) {
        return $this->update($request, false);
    }

    /**
     * @Rest\View()
     * @Rest\Put("/entreprise/{id}")
     */
    public function putEntrepriseAction(Request $request) {
        return $this->update($request, true);
    }

    private function update(Request $request, $clearMissing) {
        $this->metier = $this->get("app.entreprise.metier");
        $entreprise = $this->metier->find($request->get("id"));

        if (empty($entreprise)) {
            return View::create(['message' => 'Place not found'], Response::HTTP_NOT_FOUND);
        }

        $form = $this->createForm(EntrepriseType::class, $entreprise);
        $form->submit($request->request->all(), $clearMissing);

        if ($form->isValid()) {
            return $this->metier->update($entreprise);
        }

        return $form;
    }
}