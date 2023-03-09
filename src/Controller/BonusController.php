<?php

namespace App\Controller;

use App\Entity\Bonus;
use App\Form\BonusType;
use App\Form\PackType;
use App\Repository\BonusRepository;
use App\Repository\PackRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;



#[Route('/bonus')]
class BonusController extends AbstractController
{


    #[Route('/bonusfront', name: 'app_bonus_front', methods: ['GET'])]
    public function front(BonusRepository $bonusRepository): Response
    {
        $bonu = new Bonus();
        $bonu = [
            'nomBonus1' => '10',
            'nomBonus2' => '20',
            'nomBonus3' => '30',
            'nomBonus4' => '40'
        ];

        return $this->render('bonus/bonusfront.html.twig', [
            'bonu' => $bonu,
            'bonuses' => $bonusRepository->findAll(),
        ]);
    }

    #[Route('/', name: 'app_bonus_index', methods: ['GET'])]
    public function index(BonusRepository $bonusRepository): Response
    {
        return $this->render('bonus/index.html.twig', [
            'bonuses' => $bonusRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_bonus_new', methods: ['GET', 'POST'])]
    public function new(Request $request, BonusRepository $bonusRepository): Response
    {
        $bonu = new Bonus();
        $form = $this->createForm(BonusType::class, $bonu);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $bonusRepository->save($bonu, true);

            return $this->redirectToRoute('app_bonus_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('bonus/new.html.twig', [
            'bonu' => $bonu,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_bonus_show', methods: ['GET'])]
    public function show(Bonus $bonu): Response
    {
        return $this->render('bonus/show.html.twig', [
            'bonu' => $bonu,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_bonus_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Bonus $bonu, BonusRepository $bonusRepository): Response
    {
        $form = $this->createForm(BonusType::class, $bonu);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $bonusRepository->save($bonu, true);

            return $this->redirectToRoute('app_bonus_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('bonus/edit.html.twig', [
            'bonu' => $bonu,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_bonus_delete', methods: ['POST'])]
    public function delete(Request $request, Bonus $bonu, BonusRepository $bonusRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$bonu->getId(), $request->request->get('_token'))) {
            $bonusRepository->remove($bonu, true);
        }

        return $this->redirectToRoute('app_bonus_index', [], Response::HTTP_SEE_OTHER);
    }



}

