<?php

namespace UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DashboardController extends Controller
{
    public function dashboardAction()
    {
    	$parameters = array(
    		'val' => ''
    	);

        return $this->render(
        	'UserBundle:Dashboard:dashboard.html.twig', $parameters);
    }
}
