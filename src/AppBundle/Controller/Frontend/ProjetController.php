<?php 


namespace AppBundle\Controller\Frontend;

use AppBundle\Entity\Projet;
use AppBundle\Form\ProjetType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


class ProjetController extends Controller
{
    //    Retoune User
    public function getUser()
    {
        return $this->get('security.token_storage')->getToken()->getUser();
    }

	 /**
     * @Route("/projet/create", name="app_deposer_projet")
     */
    public function deposerProjetAction(Request $request)
    {
        $projet = new Projet();

        $form = $this->createForm(ProjetType::class, $projet);
        $em = $this->getDoctrine()->getManager();

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            if ($this->getUser() != 'anon.') {
                $projet->setUtilisateur($this->getUser());
                $em->persist($projet);
                $em->flush();

                $this->get('session')->getFlashBag()->Add('success', "Projet crée avec succès!");
                return $this->redirect($this->generateUrl('app_homepage'));
            } else {
                return $this->redirect($this->generateUrl('fos_user_security_login'));
            }
        }

    	$parameters = array(
    		'form' =>  $form->createView()
    	);

    	return $this->render(
            'AppBundle:Projet:deposer.html.twig', $parameters);
    }

}