<?php

namespace Eliastre100\PythonProjectBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Eliastre100\PythonProjectBundle\Entity\Tps;

class TpController extends Controller
{
    public function createAction(Request $request)
    {
        $tp = new Tps();
        $form = $this->createFormBuilder($tp)
            ->setAction($this->generateUrl('eliastre100_python_actions_Tp_create'))
            ->add('name', 'text')
            ->add('visibility', 'choice', array(
                'choices'   => array(
                    'owner'   => 'Perso',
                    'group' => 'Group',
                    'class'   => 'Classe',
                    ),
                'empty_value' => 'Choose a visibility'))
            ->add('save', 'submit')
            ->getForm();
        
        $form->handleRequest($request);

        if ($form->isValid()) {

            $user = $this->container->get('security.context')->getToken()->getUser();
            $tp->setOwner($user);
            $em = $this->getDoctrine()->getManager();
            $em->persist($tp);
            $em->flush();
            
            return $this->redirect($this->generateUrl('eliastre100_python_project_homepage'));
        }else{
            
    	   return $this->render('Eliastre100PythonProjectBundle:Tp:createForm.html.twig', array('form' => $form->createView()));

        }
    }
}
