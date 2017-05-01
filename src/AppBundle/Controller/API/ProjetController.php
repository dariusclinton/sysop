<?php
/**
 * Created by PhpStorm.
 * User: tsafack
 * Date: 03/04/17
 * Time: 04:04
 */

namespace AppBundle\Controller\API;


use AppBundle\Form\ProjetType;
use FOS\RestBundle\View\View;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Projet;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use FOS\RestBundle\Controller\Annotations as Rest;

class ProjetController extends Controller
{
    private $metier;

    /**
     * @Rest\View()
     * @Rest\Get("/projet")
     */
    public function getprojetsAction(Request $request) {
        $this->metier = $this->get("app.projet.metier");

        $projet = $this->metier->findAll();

        return $projet;
    }

    /**
     * @Rest\View()
     * @Rest\Get("/projet/{id}")
     */
    public function getprojetAction(Request $request) {
        $this->metier = $this->get("app.projet.metier");

        $id = $request->get("id");
        $projet = $this->metier->viewProjet($id);

        if (!$projet) {
            return View::create(['message' => 'Place not found'], Response::HTTP_NOT_FOUND);
        }

        return $projet;
    }

    /**
     * @Rest\View(statusCode=Response::HTTP_CREATED)
     * @Rest\Post("/projet")
     */
    public function postProjetsAction(Request $request) {
        $this->metier = $this->get("app.projet.metier");
        $projet = new Projet();
        $form = $this->createForm(ProjetType::class, $projet);
        $form->submit($request->request->all()); // validation des donnees

        if ($form->isValid()) {
            $this->metier->create($projet);
            return $projet;
        } else {
            return $form;
        }
    }

    /**
     * @Rest\View(statusCode=Response::HTTP_NO_CONTENT)
     * @Rest\Delete("/projet/{id}")
     */
    public function removeProjetAction(Projet $id) {
        $this->metier = $this->get("app.projet.metier");
        $this->metier->delete($id);
    }

    /**
     * @Rest\View()
     * @Rest\Patch("/projet/{id}")
     */
    public function patchProjetAction(Request $request) {
        return $this->update($request, false);
    }

    /**
     * @Rest\View()
     * @Rest\Put("/projet/{id}")
     */
    public function putProjetAction(Request $request) {
        return $this->update($request, true);
    }

    private function update(Request $request, $clearMissing) {
        $this->metier = $this->get("app.projet.metier");
        $projet = $this->metier->find($request->get("id"));

        if (empty($projet)) {
            return View::create(['message' => 'Place not found'], Response::HTTP_NOT_FOUND);
        }

        $form = $this->createForm(ProjetType::class, $projet);
        $form->submit($request->request->all(), $clearMissing);

        if ($form->isValid()) {
            return $this->metier->update($projet);
        }

        return $form;
    }
}