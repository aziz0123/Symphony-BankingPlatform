<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\CarteBancaire;
use App\Entity\Compte;
use App\Form\CarteBancaireType;
use App\Repository\CarteBancaireRepository;
use App\Repository\CompteRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints\Date;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class CarteBancaireController extends AbstractController
{


    /**
     * @Route("/displaycarte", name="displaycarte")
     */
    public function afficherCarteBancaire(PaginatorInterface $paginator, Request $request): Response
    {
        $CarteBancaire = $this->getDoctrine()->getManager()->getRepository(CarteBancaire::class)->findAll();
        $CarteBancaire = $paginator->paginate(
            $CarteBancaire,
            $request->query->getInt('page', 1),
            4
        );

        return $this->render('carte_bancaire/index.html.twig', [
            'b' => $CarteBancaire
        ]);
    }

    /**
     * @Route("/addCarte", name="addCarte")
     */
    public function addCarteBancaire(Request $request): Response
    {

        $CarteBancaire = new CarteBancaire();
        $form = $this->createForm(CarteBancaireType::class, $CarteBancaire);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {


            $em = $this->getDoctrine()->getManager();
            $CarteBancaire->setDate(new \DateTime());
            $em->persist($CarteBancaire);
            $em->flush();

            return $this->redirectToRoute('displaycarte');
        } else
            return $this->render('carte_bancaire/createCarte.html.twig', ['f' => $form->createView()]);
    }



    /**
     * @Route("/modifierCarteBancaire/{id}", name="modifierCarteBancaire")
     */
    public function modifierCarteBancaire(Request $request, $id): Response
    {

        $CarteBancaire = $this->getDoctrine()->getManager()->getRepository(CarteBancaire::class)->find($id);
        $form = $this->createForm(CarteBancaireType::class, $CarteBancaire);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {


            $em = $this->getDoctrine()->getManager();

            $em->flush();

            return $this->redirectToRoute('displaycarte');
        } else
            return $this->render('carte_bancaire/modifierCarte.html.twig', ['f' => $form->createView()]);
    }
    /**
     * @Route("/deleteCarteBancaire", name="deleteCarteBancaire")
     */
    public function deleteCarteBancaire(Request $request)
    {

        $CarteBancaire = $this->getDoctrine()->getRepository(CarteBancaire::class)->findOneBy(array('id' => $request->query->get("id")));
        $em = $this->getDoctrine()->getManager();
        $em->remove($CarteBancaire);
        $em->flush();
        return $this->redirectToRoute('displaycarte');
    }
    /**
     * @Route("setEtat/{id}", name="setEtat")
     */
    public function setEtat(CarteBancaireRepository $repository, $id): Response
    {
        $em = $this->getDoctrine()->getManager();
        $CarteBancaire = $repository->find($id);
        $etat = $CarteBancaire->getEtat();
        if ($etat == "blocage") {
            $CarteBancaire->setEtat("Active");
        } else {
            $CarteBancaire->setEtat("blocage");
        }
        $em->flush();
        return $this->redirectToRoute('displaycarte');
    }
    /**
     * @Route("demandeCarte/{id}", name="demandeCarte")
     */
    public function demandeCarte(CarteBancaireRepository $repository, $id, \Swift_Mailer $mailer, Compte $compte, CompteRepository $compteRepository): Response
    {
        $compte = $compteRepository->find($id);
        $nom = $compte->getName();
        $rib = $compte->getRib();



        $found = $repository->findBy(array('compte' => $id), array('compte' => 'ASC'));

        $em = $this->getDoctrine()->getManager();
        if ($found == null) {
            $message = (new \Swift_Message('Demande De Carte'))
                ->setFrom('skander.gassa@esprit.tn')
                ->setTo('ghada.jouini1@esprit.tn')
                ->setBody("ce client " . $nom . " de RIB:  12345-" . $rib . "-56 voudrais avoir une carte");
            //send mail
            $mailer->send($message);
        } else {
            $message = (new \Swift_Message('Demande d ajout ou blocage d une carte'))
                ->setFrom('skander.gassa@esprit.tn')
                ->setTo('ghada.jouini1@esprit.tn')
                ->setBody("ce client " . $nom . " de RIB:  12345-" . $rib . "-56 voudrais ajouter ou bloquer une carte");
            //send mail
            $mailer->send($message);
        }
        $em->flush();
        return $this->redirectToRoute('displaycarte');
    }
    #[Route('/statsType', name:'statsType')]
    public function statistique(CarteBancaireRepository $depotRepo):Response{
        // on va chercher toutes les dossier 
        $transaction = $depotRepo->findAll();
        $range1=$depotRepo->countByType1();
        $range2=$depotRepo->countByType2();
        $range3=$depotRepo->countByType3();
        
    //get number from array approuved
        $approuved1 = $range1[0][1];
        $refused1 = $range2[0][1];
        $enattente1 = $range3[0][1];
        $total1 = $range1 + $range2 + $range3;
        
     
        return $this->render('carte_bancaire/stat.html.twig', [
            'depCount1' => $approuved1,
            'depCount2' => $refused1,
            'depCount3' => $enattente1,
        ]);
    }
    
    



}
