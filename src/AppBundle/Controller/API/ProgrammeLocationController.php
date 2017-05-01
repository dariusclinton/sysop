<?php
/**
 * Created by PhpStorm.
 * User: tsafack
 * Date: 03/04/17
 * Time: 04:04
 */

namespace AppBundle\Controller\API;


use AppBundle\Form\ProgrammeLocationType;
use FOS\RestBundle\View\View;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\ProgrammeLocation;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use FOS\RestBundle\Controller\Annotations as Rest;

class ProgrammeLocationController extends Controller
{
    private $metier;

    /**
     * @Rest\View()
     * @Rest\Get("/programmeLocation")
     */
    public function getprogrammeLocationsAction(Request $request) {
        $this->metier = $this->get("app.programmelocation.metier");

        $programmeLocation = $this->metier->findAll();

        return $programmeLocation;
    }

    /**
     * @Rest\View()
     * @Rest\Get("/programmeLocation/{id}")
     */
    public function getprogrammeLocationAction(Request $request) {
        $this->metier = $this->get("app.programmelocation.metier");

        $id = $request->get("id");
        $programmeLocation = $this->metier->viewProgrammeLocation($id);

        if (!$programmeLocation) {
            return View::create(['message' => 'Place not found'], Response::HTTP_NOT_FOUND);
        }

        return $programmeLocation;
    }

    /**
     * @Rest\View(statusCode=Response::HTTP_CREATED)
     * @Rest\Post("/programmeLocation")
     */
    public function postProgrammeLocationsAction(Request $request) {
        $this->metier = $this->get("app.programmelocation.metier");
        $programmeLocation = new ProgrammeLocation();
        $form = $this->createForm(ProgrammeLocationType::class, $programmeLocation);
        $form->submit($request->request->all()); // validation des donnees

        if ($form->isValid()) {
            $this->metier->create($programmeLocation);
            return $programmeLocation;
        } else {
            return $form;
        }
    }

    /**
     * @Rest\View(statusCode=Response::HTTP_NO_CONTENT)
     * @Rest\Delete("/programmeLocation/{id}")
     */
    public function removeProgrammeLocationAction(ProgrammeLocation $id) {
        $this->metier = $this->get("app.programmelocation.metier");
        $this->metier->delete($id);
    }

    /**
     * @Rest\View()
     * @Rest\Patch("/programmeLocation/{id}")
     */
    public function patchProgrammeLocationAction(Request $request) {
        return $this->update($request, false);
    }

    /**
     * @Rest\View()
     * @Rest\Put("/programmeLocation/{id}")
     */
    public function putProgrammeLocationAction(Request $request) {
        return $this->update($request, true);
    }

    private function update(Request $request, $clearMissing) {
        $this->metier = $this->get("app.programmelocation.metier");
        $programmeLocation = $this->metier->find($request->get("id"));

        if (empty($programmeLocation)) {
            return View::create(['message' => 'Place not found'], Response::HTTP_NOT_FOUND);
        }

        $form = $this->createForm(ProgrammeLocationType::class, $programmeLocation);
        $form->submit($request->request->all(), $clearMissing);

        if ($form->isValid()) {
            return $this->metier->update($programmeLocation);
        }

        return $form;
    }
}