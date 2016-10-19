<?php

namespace EFP\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('EFPUserBundle:Default:index.html.twig', array('name' => $name));
    }
}
