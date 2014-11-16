<?php

namespace Eliastre100\GroupsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Eliastre100\GroupsBundle\Entity\Groups;

class GroupsController extends Controller
{
    public function createAction(Request $request)
    {
    	$group = new groups();
	    $form = $this->createFormBuilder($group)
	    	->add('name', 'text')
	        ->add('save', 'submit')
	        ->getForm();

        $form->handleRequest($request);

    	if ($form->isValid()) {
        // fait quelque chose comme sauvegarder la tâche dans la bdd
    		$user = $this->container->get('security.context')->getToken()->getUser();
    		$group->setOwner($user);
    		$em = $this->getDoctrine()->getManager();
    		$em->persist($group);
    		$em->flush();
    		return $this->render('Eliastre100GroupsBundle:Create:form.html.twig', array(
	            'form' => $form->createView(),
	        ));	
        	//return $this->redirect($this->generateUrl('eliastre100_user_homepage', array('name' => 'test')));
    	}else{
    		
	        return $this->render('Eliastre100GroupsBundle:Create:form.html.twig', array(
	            'form' => $form->createView(),
	        ));	
    	}
        
    }
}
