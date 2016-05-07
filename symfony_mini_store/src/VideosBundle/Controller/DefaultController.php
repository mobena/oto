<?php

namespace VideosBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
//use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

use VideosBundle\Entity\Video;
use VideosBundle\Form\VideoType;

use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class DefaultController extends Controller
{   
    public function indexAction()
    {
        $oEntityManager = $this->getDoctrine()->getEntityManager();
        
        $oVideos = $oEntityManager->getRepository("VideosBundle:Video")->findAll();
        
        return $this->render('VideosBundle:Default:index.html.twig',array('videos'=>$oVideos));
    }
    
    public function addAction(){
        
        $isFullyAuthenticated = $this->get('security.context')->isGranted('IS_AUTHENTICATED_FULLY');
        if (!$isFullyAuthenticated) {
            return $this->redirect($this->generateUrl('fos_user_login'));
        }
        
        $oEntityManager = $this->getDoctrine()->getEntityManager();
        
        $oVideo = new Video();
        
        $oForm = $this->createForm(new VideoType(), $oVideo);
        
        $oRequest = $this->getRequest();
        if ($oRequest->isMethod('POST')) {
            $oForm->bind($oRequest);
            $oVideo = $oForm->getData();
            
            $oVideo->setCreated(new \DateTime());
            
            $oEntityManager->persist($oVideo);
            $oEntityManager->flush();
            
            return $this->redirect($this->generateUrl('videos_homepage'));
        }
        
        return $this->render('VideosBundle:Default:add.html.twig', array('form' => $oForm->createView()));
    }
    
    public function playAction($idvideo)
    {
        $oEntityManager = $this->getDoctrine()->getEntityManager();
        
        $oVideo = $oEntityManager->getRepository("VideosBundle:Video")->find($idvideo);
                
        return $this->render('VideosBundle:Default:play.html.twig',array('video'=>$oVideo));
    }
}