<?php

namespace Eliastre100\PythonProjectBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Eliastre100\PythonProjectBundle\Entity\Tps;

class AjaxController extends Controller
{
    public function loadExAction($tp, $id)
    {
        return $this->render('Eliastre100PythonProjectBundle:Load:exercice.html.twig');
    }

    public function loadTreeAction()
    {
        $repository = $this->getDoctrine()
            ->getRepository('Eliastre100PythonProjectBundle:Tps');
        $tps = $repository->findByOwner($this->container->get('security.context')->getToken()->getUser());
    	return $this->render('Eliastre100PythonProjectBundle:Load:list.html.twig', array('Tps' => $tps));
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
