<?php

namespace App\Controller;

use App\Entity\Compte;
use App\Form\CompteType;
use App\Repository\AccountRepository;
use App\Repository\CompteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Notifier\Message\SmsMessage;
use Symfony\Component\Notifier\TexterInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use App\Service\MailerService;
use Twilio\Rest\Client;
use Gregwar\CaptchaBundle\Type\CaptchaType;
use Symfony\Component\OptionsResolver\OptionsResolver;


class CompteController extends AbstractController
{

    /**
     * @Route("/addCompte", name="addCompte")
     */
    public function addAccount(Request $request, CompteRepository $compteRepository): Response

    {


        $account = new Compte();
        $form = $this->createForm(CompteType::class, $account);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $rib = $account->getRib();
            $account->setRib($rib);
            $compteRepository->add($account);
            $em = $this->getDoctrine()->getManager();
            $em->persist($account);
            $em->flush();
            return $this->redirectToRoute('ShowAccount');
        } else
            return $this->render('compte/createAccount.html.twig', ['form' => $form->createView()]);
    }
    /**
     * @Route("/ShowAccount", name="ShowAccount")
     */
    public function showAccount(): Response
    {

        $account = $this->getDoctrine()->getManager()->getRepository(Compte::class)->findAll();
        return $this->render('account/show.html.twig', [
            'account' => $account,
        ]);
    }


    /**
     * @Route("/modifierAccount/{id}", name="modifierAccount")
     */
    public function modifierAccount(Request $request, $id): Response
    {

        $Account = $this->getDoctrine()->getManager()->getRepository(Compte::class)->find($id);
        $form = $this->createForm(CompteType::class, $Account);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {


            $em = $this->getDoctrine()->getManager();

            $em->flush();

            return $this->redirectToRoute('ShowAccount');
        } else
            return $this->render('account/modifierAccount.html.twig', ['f' => $form->createView()]);
    }
    /**
     * @Route("/deleteAccount", name="deleteAccount")
     */
    public function deleteAccount(Request $request)
    {

        $Account = $this->getDoctrine()->getRepository(Compte::class)->findOneBy(array('id' => $request->query->get("id")));
        $em = $this->getDoctrine()->getManager();
        $em->remove($Account);
        $em->flush();
        return $this->redirectToRoute('ShowAccount');
    }
    /**
     * @Route("activation/{id}", name="activation")
     * @param MailerService $mailerService
     */
    public function activation(CompteRepository $repository, $id, TexterInterface $texter): Response
    {
        $em = $this->getDoctrine()->getManager();
        $account = $repository->find($id);
        $account->setEtat("Active");
        $sid    = "AC58768240d4a1ae2cf48e00c295fa91e0";
        $token  = "fc4dc277988c8b3bc74fde4e436ec620";
        $twilio = new Client($sid, $token);

        $message = $twilio->messages
            ->create(
                "+21622494880", // to
                array(
                    "messagingServiceSid" => "MG35643f0e1892208274bc6c68c3d4f2fa",
                    "body" => "le compte est activee"
                )
            );
        print($message->sid);

        $em->flush();
        return $this->redirectToRoute('ShowAccount');
    }
}
