<?php

namespace Eliastre100\GroupsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Eliastre100\GroupsBundle\Entity\Groups;
use Eliastre100\GroupsBundle\Entity\Usersgroups;

class GroupsController extends Controller
{
    public function createAction(Request $request)
    {
    	$group = new groups();
	    $form = $this->createFormBuilder($group) //Generate form
            ->setAction($this->generateUrl('eliastre100_groups_create'))
	    	->add('name', 'text')
	        ->add('save', 'submit')
	        ->getForm();

        $form->handleRequest($request);

    	if ($form->isValid()) { //If form is complplete without errors we save it
    		
            $userGroups = new Usersgroups();

            $user = $this->container->get('security.context')->getToken()->getUser(); //Get current logged user
            $group->setOwner($user);
            $userGroups->setUserId($user->getId()); //Prepare temp table to add owner as first memeber of a new group


            $em = $this->getDoctrine()->getManager();
            $em->persist($group);
            $em->flush(); //Save new group and generate an ID
            
            $userGroups->setGroupId($group->getId()); //finalise temp table
            
            $em->persist($userGroups);
            $em->flush(); //And save it
        	
            return $this->redirect($this->generateUrl('eliastre100_python_project_homepage')); //then redirect to homepage
    	}else{
    		
	        return $this->render('Eliastre100GroupsBundle:Create:form.html.twig', array(
	            'form' => $form->createView(), //Else form isn't completed so send it to user
	        ));	
    	}
        
    }
}
