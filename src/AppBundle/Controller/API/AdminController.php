<?php
/**
 * Created by PhpStorm.
 * User: tsafack
 * Date: 03/04/17
 * Time: 04:04
 */

namespace AppBundle\Controller\API;


use AppBundle\Form\AdminType;
use FOS\RestBundle\View\View;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Admin;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use FOS\RestBundle\Controller\Annotations as Rest;

class AdminController extends Controller
{
    private $metier;

    /**
     * @Rest\View()
     * @Rest\Get("/admins")
     */
    public function getadminsAction(Request $request) {
        $this->metier = $this->get("app.admin.metier");

        $admin = $this->metier->findAll();

        return $admin;
    }

    /**
     * @Rest\View()
     * @Rest\Get("/admins/{id}")
     */
    public function getadminAction(Request $request) {
        $this->metier = $this->get("app.admin.metier");

        $id = $request->get("id");
        $admin = $this->metier->viewAdmin($id);

        if (!$admin) {
            return View::create(['message' => 'Place not found'], Response::HTTP_NOT_FOUND);
        }

        return $admin;
    }

    /**
     * @Rest\View(statusCode=Response::HTTP_CREATED)
     * @Rest\Post("/admins")
     */
    public function postAdminsAction(Request $request) {
        $this->metier = $this->get("app.admin.metier");
        $admin = new Admin();
        $form = $this->createForm(AdminType::class, $admin);
        $form->submit($request->request->all()); // validation des donnees

        if ($form->isValid()) {
            $this->metier->create($admin);
            return $admin;
        } else {
            return $form;
        }
    }

    /**
     * @Rest\View(statusCode=Response::HTTP_NO_CONTENT)
     * @Rest\Delete("/admins/{id}")
     */
    public function removeAdminAction(Admin $id) {
        $this->metier = $this->get("app.admin.metier");
        $this->metier->delete($id);
    }

    /**
     * @Rest\View()
     * @Rest\Patch("/admins/{id}")
     */
    public function patchAdminAction(Request $request) {
        return $this->update($request, false);
    }

    /**
     * @Rest\View()
     * @Rest\Put("/admins/{id}")
     */
    public function putAdminAction(Request $request) {
        return $this->update($request, true);
    }

    private function update(Request $request, $clearMissing) {
        $this->metier = $this->get("app.admin.metier");
        $admin = $this->metier->find($request->get("id"));

        if (empty($admin)) {
            return View::create(['message' => 'Place not found'], Response::HTTP_NOT_FOUND);
        }

        $form = $this->createForm(AdminType::class, $admin);
        $form->submit($request->request->all(), $clearMissing);

        if ($form->isValid()) {
            return $this->metier->update($admin);
        }

        return $form;
    }
}