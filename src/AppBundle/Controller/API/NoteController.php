<?php
/**
 * Created by PhpStorm.
 * User: tsafack
 * Date: 03/04/17
 * Time: 04:04
 */

namespace AppBundle\Controller\API;


use AppBundle\Form\NoteType;
use FOS\RestBundle\View\View;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Note;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use FOS\RestBundle\Controller\Annotations as Rest;

class NoteController extends Controller
{
    private $metier;

    /**
     * @Rest\View()
     * @Rest\Get("/note")
     */
    public function getnotesAction(Request $request) {
        $this->metier = $this->get("app.note.metier");

        $note = $this->metier->findAll();

        return $note;
    }

    /**
     * @Rest\View()
     * @Rest\Get("/note/{id}")
     */
    public function getnoteAction(Request $request) {
        $this->metier = $this->get("app.note.metier");

        $id = $request->get("id");
        $note = $this->metier->viewNote($id);

        if (!$note) {
            return View::create(['message' => 'Place not found'], Response::HTTP_NOT_FOUND);
        }

        return $note;
    }

    /**
     * @Rest\View(statusCode=Response::HTTP_CREATED)
     * @Rest\Post("/note")
     */
    public function postNotesAction(Request $request) {
        $this->metier = $this->get("app.note.metier");
        $note = new Note();
        $form = $this->createForm(NoteType::class, $note);
        $form->submit($request->request->all()); // validation des donnees

        if ($form->isValid()) {
            $this->metier->create($note);
            return $note;
        } else {
            return $form;
        }
    }

    /**
     * @Rest\View(statusCode=Response::HTTP_NO_CONTENT)
     * @Rest\Delete("/note/{id}")
     */
    public function removeNoteAction(Note $id) {
        $this->metier = $this->get("app.note.metier");
        $this->metier->delete($id);
    }

    /**
     * @Rest\View()
     * @Rest\Patch("/note/{id}")
     */
    public function patchNoteAction(Request $request) {
        return $this->update($request, false);
    }

    /**
     * @Rest\View()
     * @Rest\Put("/note/{id}")
     */
    public function putNoteAction(Request $request) {
        return $this->update($request, true);
    }

    private function update(Request $request, $clearMissing) {
        $this->metier = $this->get("app.note.metier");
        $note = $this->metier->find($request->get("id"));

        if (empty($note)) {
            return View::create(['message' => 'Place not found'], Response::HTTP_NOT_FOUND);
        }

        $form = $this->createForm(NoteType::class, $note);
        $form->submit($request->request->all(), $clearMissing);

        if ($form->isValid()) {
            return $this->metier->update($note);
        }

        return $form;
    }
}