<?php

namespace Eliastre100\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('Eliastre100UserBundle:Default:index.html.twig', array('name' => $name));
    }
}
