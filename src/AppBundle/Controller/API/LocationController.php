<?php
/**
 * Created by PhpStorm.
 * User: tsafack
 * Date: 03/04/17
 * Time: 04:04
 */

namespace AppBundle\Controller\API;


use AppBundle\Form\LocationType;
use FOS\RestBundle\View\View;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Location;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use FOS\RestBundle\Controller\Annotations as Rest;

class LocationController extends Controller
{
    private $metier;

    /**
     * @Rest\View()
     * @Rest\Get("/location")
     */
    public function getlocationsAction(Request $request) {
        $this->metier = $this->get("app.location.metier");

        $location = $this->metier->findAll();

        return $location;
    }

    /**
     * @Rest\View()
     * @Rest\Get("/location/{id}")
     */
    public function getlocationAction(Request $request) {
        $this->metier = $this->get("app.location.metier");

        $id = $request->get("id");
        $location = $this->metier->viewLocation($id);

        if (!$location) {
            return View::create(['message' => 'Place not found'], Response::HTTP_NOT_FOUND);
        }

        return $location;
    }

    /**
     * @Rest\View(statusCode=Response::HTTP_CREATED)
     * @Rest\Post("/location")
     */
    public function postLocationsAction(Request $request) {
        $this->metier = $this->get("app.location.metier");
        $location = new Location();
        $form = $this->createForm(LocationType::class, $location);
        $form->submit($request->request->all()); // validation des donnees

        if ($form->isValid()) {
            $this->metier->create($location);
            return $location;
        } else {
            return $form;
        }
    }

    /**
     * @Rest\View(statusCode=Response::HTTP_NO_CONTENT)
     * @Rest\Delete("/location/{id}")
     */
    public function removeLocationAction(Location $id) {
        $this->metier = $this->get("app.location.metier");
        $this->metier->delete($id);
    }

    /**
     * @Rest\View()
     * @Rest\Patch("/location/{id}")
     */
    public function patchLocationAction(Request $request) {
        return $this->update($request, false);
    }

    /**
     * @Rest\View()
     * @Rest\Put("/location/{id}")
     */
    public function putLocationAction(Request $request) {
        return $this->update($request, true);
    }

    private function update(Request $request, $clearMissing) {
        $this->metier = $this->get("app.location.metier");
        $location = $this->metier->find($request->get("id"));

        if (empty($location)) {
            return View::create(['message' => 'Place not found'], Response::HTTP_NOT_FOUND);
        }

        $form = $this->createForm(LocationType::class, $location);
        $form->submit($request->request->all(), $clearMissing);

        if ($form->isValid()) {
            return $this->metier->update($location);
        }

        return $form;
    }
}