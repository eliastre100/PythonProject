<?php

namespace Eliastre100\PythonProjectBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Eliastre100\PythonProjectBundle\Entity\Tps;
use Eliastre100\GroupsBundle\Entity;

class AjaxController extends Controller
{
    public function loadExAction($tp, $id)
    {
        return $this->render('Eliastre100PythonProjectBundle:Load:exercice.html.twig');
    }

    public function loadTreeAction()
    {
        $user = $this->container->get('security.context')->getToken()->getUser(); //Get current logged user
        $TpsRepo = $this->getDoctrine()->getRepository('Eliastre100PythonProjectBundle:Tps');
        $Tps = $TpsRepo->getGroupsFromUser($user); //Load all TP from current user

    	return $this->render('Eliastre100PythonProjectBundle:Load:list.html.twig', array('Tps' => $Tps));
    }

    public function addAction($step)
    {
    	return $this->render('Eliastre100PythonProjectBundle:Add:step_'.$step.'.html.twig');
    }

    public function removeAction($step)
    {
    	return $this->render('Eliastre100PythonProjectBundle:Remove:step_'.$step.'.html.twig');
    }
}
