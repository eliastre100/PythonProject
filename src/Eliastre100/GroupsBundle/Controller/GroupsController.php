<?php

namespace Eliastre100\GroupsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Eliastre100\GroupsBundle\Entity\Groups;
use Eliastre100\GroupsBundle\Entity\Usersgroups;
use Eliastre100\GroupsBundle\Form\Type\HireType;
use Eliastre100\GroupsBundle\Form\Type\DeleteType;
use Eliastre100\GroupsBundle\Form\Type\LeftType;

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

    public function hireAction(Request $request)
    {
        $userId = $this->container->get('security.context')->getToken()->getUser()->getId();
        $form = $this->createForm(new HireType($userId, $this->generateUrl('eliastre100_groups_hire')));

        $form->handleRequest($request);
       
        if ($form->isValid()) {

            $data = $form->getData();
            //On verifit les infos et on envoi l'enregistrement

            //On verifit que l'utilisateur possède le groupe
            $groupsRepository = $this->getDoctrine()->getRepository('Eliastre100GroupsBundle:Groups');
            if($groupsRepository->testOwnerGroup($userId, $data['Group']->getId())){
                //On verfit que l'utilisateur n'est pas deja dans le goupe
                $UsersGroupsRepository = $this->getDoctrine()->getRepository('Eliastre100GroupsBundle:Usersgroups');
                if(!$UsersGroupsRepository->isIfInGroup($data['User']->getId(), $data['Group']->getId())){
                    //On sauvegarde l'utilisateur
                    $userToAdd = new Usersgroups();
                    $userToAdd->setUserId($data['User']->getId());
                    $userToAdd->setGroupId($data['Group']->getId());

                    
                    $em = $this->getDoctrine()->getManager();
                    $em->persist($userToAdd);
                    $em->flush();

                    return $this->redirect($this->generateUrl('eliastre100_python_project_homepage')); //then redirect to homepage
                }else{
                    
                }
            }else{

            }
        }else{
            return $this->render('Eliastre100GroupsBundle:Hire:form.html.twig', array('form' => $form->createView()));     
        }
    }

    public function fireAction(Request $request)
    {
        $userId = $this->container->get('security.context')->getToken()->getUser()->getId();
        $form = $this->createForm(new HireType($userId, $this->generateUrl('eliastre100_groups_fire'), 'Fire'));

        $form->handleRequest($request);
       
        if ($form->isValid()) {

            $data = $form->getData();
            //On verifit les infos et on envoi l'enregistrement

            //On verifit que l'utilisateur possède le groupe
            $groupsRepository = $this->getDoctrine()->getRepository('Eliastre100GroupsBundle:Groups');
            if($groupsRepository->testOwnerGroup($userId, $data['Group']->getId())){
                //On verfit que l'utilisateur n'est pas deja dans le goupe
                $UsersGroupsRepository = $this->getDoctrine()->getRepository('Eliastre100GroupsBundle:Usersgroups');
                if($data['User']->getId() != $userId){              
                    if($UsersGroupsRepository->isIfInGroup($data['User']->getId(), $data['Group']->getId())){
                        //On sauvegarde l'utilisateur
                        $userToRemove = $UsersGroupsRepository->UserInGroup($data['User']->getId(), $data['Group']->getId());
                        
                        $em = $this->getDoctrine()->getManager();
                        $em->remove($userToRemove[0]);
                        $em->flush();

                        return $this->redirect($this->generateUrl('eliastre100_python_project_homepage')); //then redirect to homepage
                    }else{
                        
                    }
                }
            }else{

            }
        }else{
            return $this->render('Eliastre100GroupsBundle:Hire:form.html.twig', array('form' => $form->createView()));     
        }
    }

    public function deleteAction(Request $request){
        $userId = $this->container->get('security.context')->getToken()->getUser()->getId();
        $form = $this->createForm(new DeleteType($userId, $this->generateUrl('eliastre100_groups_delete'), 'Delete'));

        $form->handleRequest($request);
       
        if ($form->isValid()) {

            $data = $form->getData();
            //On verifit les infos et on envoi l'enregistrement

            //On verifit que l'utilisateur possède le groupe
            $groupsRepository = $this->getDoctrine()->getRepository('Eliastre100GroupsBundle:Groups');
            if($groupsRepository->testOwnerGroup($userId, $data['Group']->getId())){
                //On verfit que l'utilisateur n'est pas deja dans le goupe
                $UsersGroupsRepository = $this->getDoctrine()->getRepository('Eliastre100GroupsBundle:Usersgroups');
                $userToRemove = $UsersGroupsRepository->UserFromGroup($data['Group']->getId());
                
                $em = $this->getDoctrine()->getManager();
                foreach ($userToRemove as $key => $value) {
                    $em->remove($userToRemove[$key]);
                }
                $em->remove($data['Group']);
                $em->flush();

                return $this->redirect($this->generateUrl('eliastre100_python_project_homepage')); //then redirect to homepage
            }else{

            }
        }else{
            return $this->render('Eliastre100GroupsBundle:Hire:form.html.twig', array('form' => $form->createView())); 
        }  
    }

    public function leftAction(Request $request)
    {
        $userId = $this->container->get('security.context')->getToken()->getUser()->getId();
        $em_UserGroups = $this->getDoctrine()->getRepository('Eliastre100GroupsBundle:Usersgroups');
        $form = $this->createForm(new LeftType($userId, $this->generateUrl('eliastre100_groups_left'), $em_UserGroups, 'Left'));

        $form->handleRequest($request);
       
        if ($form->isValid()) {

            $data = $form->getData();
            //On verifit les infos et on envoi l'enregistrement
            //var_dump($data); die();

            if($em_UserGroups->isIfInGroup($userId, $data['Group'])){
                //On verfit que l'utilisateur n'est pas deja dans le goupe
                $groupsRepository = $this->getDoctrine()->getRepository('Eliastre100GroupsBundle:Groups');
                if(!$groupsRepository->testOwnerGroup($userId, $data['Group'])){
                    $userToRemove = $em_UserGroups->UserInGroup($userId, $data['Group']);
                    
                    $em = $this->getDoctrine()->getManager();
                    foreach ($userToRemove as $key => $value) {
                        $em->remove($userToRemove[$key]);
                    }
                    $em->flush();

                    return $this->redirect($this->generateUrl('eliastre100_python_project_homepage')); //then redirect to homepage
                }else{
                    die('L\'administateur du group ne peut pas le quitter il faut pour cela le dissoudre');
                }
            }else{

            }
        }else{
            return $this->render('Eliastre100GroupsBundle:Hire:form.html.twig', array('form' => $form->createView())); 
        }  
    }
}
