<?php
/**
 * Created by PhpStorm.
 * User: tsafack
 * Date: 03/04/17
 * Time: 04:04
 */

namespace AppBundle\Controller\API;


use AppBundle\Form\SolliciterType;
use FOS\RestBundle\View\View;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Solliciter;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use FOS\RestBundle\Controller\Annotations as Rest;

class SolliciterController extends Controller
{
    private $metier;

    /**
     * @Rest\View()
     * @Rest\Get("/solliciter")
     */
    public function getsollicitersAction(Request $request) {
        $this->metier = $this->get("app.solliciter.metier");

        $solliciter = $this->metier->findAll();

        return $solliciter;
    }

    /**
     * @Rest\View()
     * @Rest\Get("/solliciter/{id}")
     */
    public function getsolliciterAction(Request $request) {
        $this->metier = $this->get("app.solliciter.metier");

        $id = $request->get("id");
        $solliciter = $this->metier->viewSolliciter($id);

        if (!$solliciter) {
            return View::create(['message' => 'Place not found'], Response::HTTP_NOT_FOUND);
        }

        return $solliciter;
    }

    /**
     * @Rest\View(statusCode=Response::HTTP_CREATED)
     * @Rest\Post("/solliciter")
     */
    public function postSollicitersAction(Request $request) {
        $this->metier = $this->get("app.solliciter.metier");
        $solliciter = new Solliciter();
        $form = $this->createForm(SolliciterType::class, $solliciter);
        $form->submit($request->request->all()); // validation des donnees

        if ($form->isValid()) {
            $this->metier->create($solliciter);
            return $solliciter;
        } else {
            return $form;
        }
    }

    /**
     * @Rest\View(statusCode=Response::HTTP_NO_CONTENT)
     * @Rest\Delete("/solliciter/{id}")
     */
    public function removeSolliciterAction(Solliciter $id) {
        $this->metier = $this->get("app.solliciter.metier");
        $this->metier->delete($id);
    }

    /**
     * @Rest\View()
     * @Rest\Patch("/solliciter/{id}")
     */
    public function patchSolliciterAction(Request $request) {
        return $this->update($request, false);
    }

    /**
     * @Rest\View()
     * @Rest\Put("/solliciter/{id}")
     */
    public function putSolliciterAction(Request $request) {
        return $this->update($request, true);
    }

    private function update(Request $request, $clearMissing) {
        $this->metier = $this->get("app.solliciter.metier");
        $solliciter = $this->metier->find($request->get("id"));

        if (empty($solliciter)) {
            return View::create(['message' => 'Place not found'], Response::HTTP_NOT_FOUND);
        }

        $form = $this->createForm(SolliciterType::class, $solliciter);
        $form->submit($request->request->all(), $clearMissing);

        if ($form->isValid()) {
            return $this->metier->update($solliciter);
        }

        return $form;
    }
}