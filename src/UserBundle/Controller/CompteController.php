<?php

namespace UserBundle\Controller;

use AppBundle\Entity\Diplome;
use AppBundle\Entity\Evenement;
use AppBundle\Entity\Experience;
use AppBundle\Entity\Specialite;
use AppBundle\Form\DiplomeType;
use AppBundle\Form\EvenementType;
use AppBundle\Form\ExperienceType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class CompteController extends Controller
{
    //    Retoune User
    public function getUser()
    {
        return $this->get('security.token_storage')->getToken()->getUser();
    }

    public function agendaAction(Request $request)
    {
        $metier_evenement = $this->get("app.evenement.metier");
        $it = $this->getUser()->getInfosTravailleur();
        $agenda = $it->getAgenda();

        $evenement = new Evenement();
        $form = $this->createForm(EvenementType::class, $evenement);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $evenement->setAgenda($agenda);
            $metier_evenement->create($evenement);

            $this->get('session')->getFlashBag()->Add('success', "Evenement crée avec succès!");
            return $this->redirect($this->generateUrl('user_travailleur_agenda'));
        }

        $parameters = array(
            'form' =>  $form->createView(),
            'evenements' => $agenda->getEvenements()
        );

        return $this->render(
        	'UserBundle:Profile:agenda.html.twig', $parameters);
    }

    public function removeEvenementAction(Request $request, Evenement $evenement)
    {
        $metier_evenement = $this->get("app.evenement.metier");
        $metier_evenement->delete($evenement);

        return $this->redirectToRoute('user_travailleur_agenda');
    }

    public function updateEvenementAction(Request $request, Evenement $evenement)
    {
        $metier_evenement = $this->get("app.evenement.metier");
        $it = $this->getUser()->getInfosTravailleur();
        $agenda = $it->getAgenda();

        $form = $this->createForm(EvenementType::class, $evenement);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $metier_evenement->update($evenement);

            $this->get('session')->getFlashBag()->Add('success', "Evenement mis à jour avec succès!");
            return $this->redirect($this->generateUrl('user_travailleur_agenda'));
        }

        $parameters = array(
            'form' =>  $form->createView(),
            'evenements' => $agenda->getEvenements()
        );

        return $this->render(
            'UserBundle:Profile:agenda.html.twig', $parameters);
    }

    // Specialites
    public function specialitesAction()
    {
        $metier_specialites = $this->get("app.specialite.metier");

        $specialites_user = $metier_specialites->listSpecialitesByUser($this->getUser()->getId());
        $specialites = $metier_specialites->findAll();

        $temp = [];
        foreach ($specialites as $sp) {
            $count = 0;
            foreach ($specialites_user as $spu) {
                if ($sp->getId() == $spu->getId()) {
                    $count ++;
                }
            }
            if ($count == 0) array_push($temp, $sp);
        }

        $specialites = $temp;

    	$parameters = array(
    		'form' => '',
            'specialites' => $specialites,
            'specialites_user' => $specialites_user
    	);

        return $this->render(
        	'UserBundle:Profile:specialites.html.twig', $parameters);
    }

    public function addSpecialiteAction(Request $request)
    {
        $specialite = $request->query->get('specialite');
        $metier_specialites = $this->get("app.specialite.metier");
        $metier_it = $this->get("app.infosTravailleur.metier");

//        dump($metier_specialites->find($specialite)); die;
        $it = $this->getUser()->getInfosTravailleur();
        $it->addSpecialite($metier_specialites->find($specialite));
        $metier_it->update($it);

        return $this->redirectToRoute('user_travailleur_specialites');
    }

    public function removeSpecialiteAction(Request $request, Specialite $specialite)
    {
        $metier_it = $this->get("app.infosTravailleur.metier");
        $it = $this->getUser()->getInfosTravailleur();
        $it->removeSpecialite($specialite);
        $metier_it->update($it);

        return $this->redirectToRoute('user_travailleur_specialites');
    }


    // Diplômes
    public function diplomesAction(Request $request)
    {
        $metier_it = $this->get("app.infosTravailleur.metier");
        $metier_diplome = $this->get("app.diplome.metier");
        $it = $this->getUser()->getInfosTravailleur();

        $diplome = new Diplome();
        $form = $this->createForm(DiplomeType::class, $diplome);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $diplome->setInfosTravailleur($it);
            $it->addDiplome($metier_diplome->create($diplome));
            $metier_it->update($it);

            $this->get('session')->getFlashBag()->Add('success', "Diplome crée avec succès!");
            return $this->redirect($this->generateUrl('user_travailleur_diplomes'));
        }

//        dump($form->ge); die;

        $parameters = array(
            'form' =>  $form->createView(),
            'diplomes' => $it->getDiplomes()
        );

        return $this->render(
        	'UserBundle:Profile:diplomes.html.twig', $parameters);
    }

    public function removeDiplomeAction(Request $request, Diplome $diplome)
    {
        $metier_diplome = $this->get("app.diplome.metier");
        $metier_diplome->delete($diplome);

        return $this->redirectToRoute('user_travailleur_diplomes');
    }

    public function updateDiplomeAction(Request $request, Diplome $diplome)
    {
        $metier_diplome = $this->get("app.diplome.metier");

        $form = $this->createForm(DiplomeType::class, $diplome);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $metier_diplome->update($diplome);

            $this->get('session')->getFlashBag()->Add('success', "Diplome mis à jour avec succès!");
            return $this->redirect($this->generateUrl('user_travailleur_diplomes'));
        }

//        dump($form); die;

        $it = $this->getUser()->getInfosTravailleur();
        $parameters = array(
            'form' =>  $form->createView(),
            'diplomes' => $it->getDiplomes()
        );

        return $this->render(
            'UserBundle:Profile:diplomes.html.twig', $parameters);
    }


    // Experiences
    public function experiencesAction(Request $request)
    {
        $metier_it = $this->get("app.infosTravailleur.metier");
        $metier_experience = $this->get("app.experience.metier");
        $it = $this->getUser()->getInfosTravailleur();

        $experience = new Experience();
        $form = $this->createForm(ExperienceType::class, $experience);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $experience->setInfosTravailleur($it);
            $it->addExperience($metier_experience->create($experience));
            $metier_it->update($it);

            $this->get('session')->getFlashBag()->Add('success', "Experience crée avec succès!");
            return $this->redirect($this->generateUrl('user_travailleur_experiences'));
        }

//        dump($form->ge); die;

        $parameters = array(
            'form' =>  $form->createView(),
            'experiences' => $it->getExperiences()
        );

        return $this->render(
        	'UserBundle:Profile:experiences.html.twig', $parameters);
    }

    public function removeExperienceAction(Request $request, Experience $experience)
    {
        $metier_experience = $this->get("app.experience.metier");
        $metier_experience->delete($experience);

        return $this->redirectToRoute('user_travailleur_experiences');
    }

    public function updateExperienceAction(Request $request, Experience $experience)
    {
        $metier_experience = $this->get("app.experience.metier");

        $form = $this->createForm(ExperienceType::class, $experience);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $metier_experience->update($experience);

            $this->get('session')->getFlashBag()->Add('success', "Experience mis à jour avec succès!");
            return $this->redirect($this->generateUrl('user_travailleur_experiences'));
        }

//        dump($form); die;

        $it = $this->getUser()->getInfosTravailleur();
        $parameters = array(
            'form' =>  $form->createView(),
            'experiences' => $it->getExperiences()
        );

        return $this->render(
            'UserBundle:Profile:experiences.html.twig', $parameters);
    }
}
