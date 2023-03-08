<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Type;
use App\Form\TypeType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class TypeController extends AbstractController
{
    #[Route('/type', name: 'app_type')]
    public function index(): Response
    {
        return $this->render('type/index.html.twig', [
            'controller_name' => 'TypeController',
        ]);
    }

     /**
     * @Route("/displayback ", name="displayback")
     */
    public function displaybackt(): Response
    {
        $type= $this->getDoctrine()->getManager()->getRepository(Type::class)->findAll();
        return $this->render('baseback.html.twig', [
            'b'=>$type
        ]);
    } 
    

    /**
     * @Route("/displaytype", name="displaytype")
     */
    public function affichertype(): Response
    {
        $Type= $this->getDoctrine()->getManager()->getRepository(Type::class)->findAll();
        return $this->render('type/index.html.twig', [
            'b'=>$Type
        ]);
    }

        
/**
     * @Route("/addType", name="addType")
     */
    public function addType(Request $request,MailerInterface $mailer): Response
    {
      
       $Type=new Type();
       $form=$this->createForm(TypeType::class,$Type);

        $form->handleRequest($request);
       if($form->isSubmitted() && $form->isValid()){
           
         $em = $this->getDoctrine()->getManager();
           $email = (new Email())
               ->from('hanine.benayed@esprit.tn')
               ->to('hanine.benayed@esprit.tn')
               ->subject('Test email')
               ->text('This is a test email sent from Symfony');

           $mailer->send($email);
         $em->persist($Type);

         $em->flush();


           return $this->redirectToRoute('displaytype');
       }
       else
       return $this->render('type/createtype.html.twig',['b'=>$form->createView()]);

    }


      
    /**
     * @Route("/modifierType/{id}", name="modifierType")
     */
    public function modifierType(Request $request,$id): Response
    {
      
       $Types=$this->getDoctrine()->getManager()->getRepository(Type::class)->find($id);
       $b=$this->createForm(TypeType::class,$Types);
       $b->handleRequest($request);
       if($b->isSubmitted() && $b->isValid()){
    
       
           $em = $this->getDoctrine()->getManager();
           
           $em->flush();

           return $this->redirectToRoute('displaytype');
       }
       else
       return $this->render('type/modifierType.html.twig',['b'=>$b->createView()]);

    }


    /**
     * @Route("/deleteType", name="deleteType")
     */
    public function deleteType(Request $request){

        $Type=$this->getDoctrine()->getRepository(Type::class)->findOneBy(array('id'=>$request->query->get("id")));
        $em=$this->getDoctrine()->getManager();
        $em->remove($Type);
        $em->flush();
        $this->redirectToRoute('displaytype');

    }
}
