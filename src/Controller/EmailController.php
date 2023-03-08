<?php

namespace App\Controller;

use App\Form\EmailFormType;
use App\Service\EmailData;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

class EmailController extends AbstractController
{
    /**
     * @Route("/demandeCartemail", name="demandeCartemail")
     */
    public function demandeCarte(\Swift_Mailer $mailer, Request $request): Response
    {
        $form = $this->createForm(EmailFormType::class);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            $contactFormData = $form->getData();

            $message = (new \Swift_Message())
                ->setFrom($contactFormData['email'])
                ->setTo('haninebenayed1999@gmail.com')
                ->setSubject('Demande de carte')
                ->setBody(
                    'Sender : ' . $contactFormData['nom'] . \PHP_EOL .
                        $contactFormData['Message'],
                    'text/plain avec le rib:' 
                );
            $mailer->send($message);

            $this->addFlash('success', 'Vore message a été envoyé');

            return $this->redirectToRoute('contact');
        }

        return $this->render('email/contact.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
