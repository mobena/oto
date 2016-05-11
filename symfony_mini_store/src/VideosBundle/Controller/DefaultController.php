<?php

namespace VideosBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

use VideosBundle\Entity\Video;
use VideosBundle\Form\VideoType;

use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class DefaultController extends Controller
{   
    public function indexAction()
    {
        $oEntityManager = $this->getDoctrine()->getManager();
        
        $oVideos = $oEntityManager->getRepository("VideosBundle:Video")->findAll();
        
        return $this->render('VideosBundle:Default:index.html.twig',array('videos'=>$oVideos));
    }
    
    public function addAction(Request $oRequest){
        
        $oEntityManager = $this->getDoctrine()->getManager();
        
        $oVideo = new Video();
        
        //$oForm = $this->createForm(new VideoType(), $oVideo);
        
        $oForm = $this->createFormBuilder($oVideo)
            ->add('name', TextType::class)
            ->add('description', TextType::class)
            ->add('source', TextType::class)
            ->add('save', SubmitType::class, array('label' => 'Create Video'))
            ->getForm();
        
        $oForm->handleRequest($oRequest);

        if ($oForm->isValid()) {
            $oVideo = $oForm->getData();
            
            $oVideo->setCreated(new \DateTime());
            $oVideo->setUserCreator($this->getUser()->getId());
            $oVideo->setStatusVisibility(1);
            
            $oEntityManager->persist($oVideo);
            $oEntityManager->flush();
            
            return $this->redirect($this->generateUrl('videos_homepage'));
        }
        
        return $this->render('VideosBundle:Default:add.html.twig', array('form' => $oForm->createView()));
    }
    
    public function playAction($idvideo)
    {
        $oEntityManager = $this->getDoctrine()->getManager();
        
        $oVideo = $oEntityManager->getRepository("VideosBundle:Video")->find($idvideo);
                
        return $this->render('VideosBundle:Default:play.html.twig',array('video'=>$oVideo));
    }
}
