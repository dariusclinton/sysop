<?php

namespace UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CompteController extends Controller
{
    public function agendaAction()
    {
    	$parameters = array(
    		'form' => ''
    	);

        return $this->render(
        	'UserBundle:Profile:agenda.html.twig', $parameters);
    }

    public function specialitesAction()
    {
    	$parameters = array(
    		'form' => ''
    	);

        return $this->render(
        	'UserBundle:Profile:specialites.html.twig', $parameters);
    }

    public function diplomesAction()
    {
    	$parameters = array(
    		'form' => ''
    	);

        return $this->render(
        	'UserBundle:Profile:diplomes.html.twig', $parameters);
    }

    public function experiencesAction()
    {
    	$parameters = array(
    		'form' => ''
    	);

        return $this->render(
        	'UserBundle:Profile:experiences.html.twig', $parameters);
    }
}
