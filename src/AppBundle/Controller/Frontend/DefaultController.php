<?php

namespace AppBundle\Controller\Frontend;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;


class DefaultController extends Controller
{
    
    /**
     * @Route("/", name="app_homepage")
     */
    public function indexAction()
    {
        return $this->render('AppBundle:Default:index.html.twig');
    }


    /**
     * @Route("/comment-ca-marche", name="app_comment_ca_marche")
     */
    public function commentCaMarcheAction()
    {
        return $this->render('AppBundle:Default:comment_ca_marche.html.twig');
    }
}
