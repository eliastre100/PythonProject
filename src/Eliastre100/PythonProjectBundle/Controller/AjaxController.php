<?php

namespace Eliastre100\PythonProjectBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AjaxController extends Controller
{
    public function loadExAction($tp, $id)
    {
        return $this->render('Eliastre100PythonProjectBundle:Load:exercice.html.twig');
    }

    public function loadTreeAction()
    {
    	return $this->render('Eliastre100PythonProjectBundle:Load:list.html.twig');
    }
}
