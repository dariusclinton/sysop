<?php
/**
 * Created by PhpStorm.
 * User: tsafack
 * Date: 03/04/17
 * Time: 04:04
 */

namespace AppBundle\Controller\API;


use AppBundle\Form\ProgrammeType;
use FOS\RestBundle\View\View;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Programme;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use FOS\RestBundle\Controller\Annotations as Rest;

class ProgrammeController extends Controller
{
    private $metier;

    /**
     * @Rest\View()
     * @Rest\Get("/programme")
     */
    public function getprogrammesAction(Request $request) {
        $this->metier = $this->get("app.programme.metier");

        $programme = $this->metier->findAll();

        return $programme;
    }

    /**
     * @Rest\View()
     * @Rest\Get("/programme/{id}")
     */
    public function getprogrammeAction(Request $request) {
        $this->metier = $this->get("app.programme.metier");

        $id = $request->get("id");
        $programme = $this->metier->viewProgramme($id);

        if (!$programme) {
            return View::create(['message' => 'Place not found'], Response::HTTP_NOT_FOUND);
        }

        return $programme;
    }

    /**
     * @Rest\View(statusCode=Response::HTTP_CREATED)
     * @Rest\Post("/programme")
     */
    public function postProgrammesAction(Request $request) {
        $this->metier = $this->get("app.programme.metier");
        $programme = new Programme();
        $form = $this->createForm(ProgrammeType::class, $programme);
        $form->submit($request->request->all()); // validation des donnees

        if ($form->isValid()) {
            $this->metier->create($programme);
            return $programme;
        } else {
            return $form;
        }
    }

    /**
     * @Rest\View(statusCode=Response::HTTP_NO_CONTENT)
     * @Rest\Delete("/programme/{id}")
     */
    public function removeProgrammeAction(Programme $id) {
        $this->metier = $this->get("app.programme.metier");
        $this->metier->delete($id);
    }

    /**
     * @Rest\View()
     * @Rest\Patch("/programme/{id}")
     */
    public function patchProgrammeAction(Request $request) {
        return $this->update($request, false);
    }

    /**
     * @Rest\View()
     * @Rest\Put("/programme/{id}")
     */
    public function putProgrammeAction(Request $request) {
        return $this->update($request, true);
    }

    private function update(Request $request, $clearMissing) {
        $this->metier = $this->get("app.programme.metier");
        $programme = $this->metier->find($request->get("id"));

        if (empty($programme)) {
            return View::create(['message' => 'Place not found'], Response::HTTP_NOT_FOUND);
        }

        $form = $this->createForm(ProgrammeType::class, $programme);
        $form->submit($request->request->all(), $clearMissing);

        if ($form->isValid()) {
            return $this->metier->update($programme);
        }

        return $form;
    }
}