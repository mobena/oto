<?php

namespace UsersBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use UsersBundle\Entity\User;
use UsersBundle\Form\UserType;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $userManager = $this->get('fos_user.user_manager');
        $oUsers = $userManager->findUsers();
        
        return $this->render('UsersBundle:Default:index.html.twig',array('users'=>$oUsers));
    }
    
}
