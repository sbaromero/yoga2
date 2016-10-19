<?php

namespace EFP\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Form\FormError;
use EFP\UserBundle\Entity\User;
use EFP\UserBundle\Form\UserType;


class UserController extends Controller
{
    
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $dql = "SELECT u FROM EFPUserBundle:User u ORDER BY u.id DESC";
        $users = $em->createQuery($dql);  
        
        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $users, $request->query->getInt('page' , 1),
            10
        );
        
        $deleteFormAjax = $this->createCustomForm(':USER_ID', 'DELETE', 'efp_user_delete');

        return $this->render('EFPUserBundle:User:index.html.twig',array('pagination' => $pagination, 'delete_form_ajax' => $deleteFormAjax->createView()));
    }

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    public function addAction(Request $request)
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            
            $password = $form->get('password')->getData();
            
            $passwordConstraint = new Assert\NotBlank();
            $errorList = $this->get('validator')->validate($password, $passwordConstraint);
            
            if(count($errorList) == 0){
                $encoder = $this->container->get('security.password_encoder');
                $encoded = $encoder->encodePassword($user, $password);
                $user->setPassword($encoded);
                
                
                $em = $this->getDoctrine()->getManager();
                $em->persist($user);
                $em->flush();
                
                $successMessage = $this->get('translator')->trans('The user has been created.');
                $this->addFlash('mensaje', $successMessage);
                
                return $this->redirectToRoute('efp_user_index');
            }else{
                $errorMessege = new FormError($errorList[0]->getMessage());
                $form->get('password')->addError($errorMessege);
            }
        }
        
        return $this->render('EFPUserBundle:User:add.html.twig', array('form' => $form->createView()));
    }

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

   public function editAction($id, Request $request)
   {
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('EFPUserBundle:User')->find($id);
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request); 
        
        if(!$user){
            $messageException = $this->get('translator')->trans('User not found');
            throw $this->createNotFoundException($messageException);
        }
       
        if ($form->isSubmitted() && $form->isValid()) {
            
            
            $password = $form->get('password')->getData();
            
            if(!empty($password)){
                $encoder = $this->container->get('security.password_encoder');
                $encoded = $encoder->encodePassword($user, $password);
                $user->setPassword($encoded);
            }else{
                $recoverPass = $this->recoverPass($id);
                //print_r($recoverPass);
                //exit();
                $user->setPassword($recoverPass[0]['password']); 
            }
            
            if($form->get('role')->getData() == 'ROLE_ADMIN'){
                $user->setIsActive(1);
            }
            
            $em->flush();
            
            $successMessage = $this->get('translator')->trans('The user has been modified.');
            $this->addFlash('mensaje', $successMessage);
            
            return $this->redirectToRoute('efp_user_index');
        }
       
        return $this->render('EFPUserBundle:User:edit.html.twig', array('user' => $user, 'form' => $form->createView()));
   }
   
   private function recoverPass($id)
   {
       $em = $this->getDoctrine()->getManager();
       $query = $em->createQuery('SELECT u.password FROM EFPUserBundle:User u WHERE u.id = :id')->setParameter('id', $id);
       $currentPass = $query->getResult();
       return $currentPass;
   }


    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    public function viewAction($id)
    {
        $repository = $this->getDoctrine()->getRepository('EFPUserBundle:User');
        
        $user = $repository->find($id);
        
        if(!$user){
            $messageException = $this->get('translator')->trans('User not found');
            throw $this->createNotFoundException($messageException);
        }
        
        $deleteForm = $this->createCustomForm($user->getId(), 'DELETE', 'efp_user_delete');
        
        return $this->render('EFPUserBundle:User:view.html.twig', array('user' => $user, 'delete_form' => $deleteForm->createView()));
    }

    public function deleteAction($id, Request $request)
    {
        
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('EFPUserBundle:User')->find($id);
        
        
        if(!$user){
            $messageException = $this->get('translator')->trans('User not found');
            throw $this->createNotFoundException($messageException);
        }
        
        $allUsers = $em->getRepository('EFPUserBundle:User')->findAll();
        $countUsers = count($allUsers);
        
        
        $form = $this->createCustomForm($user->getId(), 'DELETE', 'efp_user_delete');
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            
            if($request->isXMLHttpRequest()){
                $res = $this->deleteUser($user->getRole(), $em, $user);
                
                return new Response(
                    json_encode(array('removed' => $res['removed'], 'message' => $res['message'], 'countUsers' => $countUsers)),
                    200,
                    array('Content-Type' => 'application/json')
                );
            }
            
            $res = $this->deleteUser($user->getRole(), $em, $user);
            
            $this->addFlash($res['alert'], $res['message']);
            
            return $this->redirectToRoute('efp_user_index');
        }
        
        return $this->render('EFPUserBundle:User:edit.html.twig', array('user' => $user, 'form' => $form->createView()));
    }
    
    private function createCustomForm($id, $method, $route){
        
        return $this->createFormBuilder()
            ->setAction($this->generateUrl($route, array('id' => $id)))
            ->setMethod($method)
            ->getForm();
        
    }
    
    private function deleteUser($role, $em, $user)
    {
        if($role == 'ROLE_USER')
        {
            $em->remove($user);
            $em->flush();
            
            $message = $this->get('translator')->trans('El alumno ha sido borrado.');
            $removed = 1;
            $alert = 'mensaje';
        }
        elseif($role == 'ROLE_ADMIN')
        {
            $message = $this->get('translator')->trans('El alumno no pudo ser borrado.');
            $removed = 0;
            $alert = 'error';
        }
        
        return array('removed' => $removed, 'message' => $message, 'alert' => $alert);
    }
}
