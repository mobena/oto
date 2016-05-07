<?php

namespace UsersBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use UsersBundle\Entity\User;
use UsersBundle\Form\UserType;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $oEntityManager = $this->getDoctrine()->getManager();
        
        $oUsers = $oEntityManager->getRepository("UsersBundle:User")->findAll();
        
        return $this->render('UsersBundle:Default:index.html.twig',array('users'=>$oUsers));
    }
    
    public function addAction(){
        
        $oEntityManager = $this->getDoctrine()->getManager();
        
        $oUser = new User();
        $oForm = $this->createForm(new UserType(), $oUser);
        
        $oRequest = $this->getRequest();
        if ($oRequest->isMethod('POST')) {
            $oForm->bind($oRequest);
            $oUser = $oForm->getData();
            
            $oEntityManager->persist($oUser);
            $oEntityManager->flush();
            
            return $this->redirect($this->generateUrl('users_homepage'));
        }
        
        /*$oUser = new User();
        $oUser->setLogin('momo')
              ->setPassword('pwd')
              ->setName('Benabdallah')
              ->setFirstname('Mohamed')
              ->setCreated(new \DateTime())
              ->setUpdated(new \DateTime());
        */
        //$oEntityManager->persist($oUser);
        //$oEntityManager->flush();
        
        return $this->render('UsersBundle:Default:add.html.twig', array('form' => $oForm->createView()));
    }
}
