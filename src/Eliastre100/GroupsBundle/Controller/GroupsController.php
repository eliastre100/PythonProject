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
	    $form = $this->createFormBuilder($group)
            ->setAction($this->generateUrl('eliastre100_groups_create'))
	    	->add('name', 'text')
	        ->add('save', 'submit')
	        ->getForm();

        $form->handleRequest($request);

    	if ($form->isValid()) {
    		
            $userGroups = new Usersgroups();

            $user = $this->container->get('security.context')->getToken()->getUser();
            $group->setOwner($user);
            $userGroups->setUserId($user->getId());


            $em = $this->getDoctrine()->getManager();
            $em->persist($group);
            $em->flush();
            
            $userGroups->setGroupId($group->getId());
            
            $em->persist($userGroups);
            $em->flush();
        	
            return $this->redirect($this->generateUrl('eliastre100_python_project_homepage'));
    	}else{
    		
	        return $this->render('Eliastre100GroupsBundle:Create:form.html.twig', array(
	            'form' => $form->createView(),
	        ));	
    	}
        
    }
}
