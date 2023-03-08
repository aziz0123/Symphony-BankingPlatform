<?php

namespace App\Controller;

use App\Entity\CompteBancaire;
use App\Form\CompteBancaireType;
use App\Repository\CompteBancaireRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/bancaire')]

class CompteBancaireController extends AbstractController
{


    #[Route('/test', name: 'test')]
    public function test(): Response
    {
        return $this->render('base-back.html.twig', [
            'controller_name' => 'CompteBancaireController',
        ]);
    }

    #[Route('/compte', name: 'app_compte_bancaire')]
    public function compte(): Response
    {
        return $this->render('compte_bancaire/compte.html.twig', [
            'controller_name' => 'CompteBancaireController',
        ]);
    }

    
    #[Route('/home', name: 'tt')]
    public function home(): Response
    {
        return $this->render('base-front.html.twig');
    }


    #[Route('/', name: 'app_compte_bancaire_index', methods: ['GET'])]
    public function index(CompteBancaireRepository $compteBancaireRepository): Response
    {
        return $this->render('compte_bancaire/index.html.twig', [
            'compte_bancaires' => $compteBancaireRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_compte_bancaire_new', methods: ['GET', 'POST'])]
    public function new(Request $request, CompteBancaireRepository $compteBancaireRepository): Response
    {
        $compteBancaire = new CompteBancaire();
        $form = $this->createForm(CompteBancaireType::class, $compteBancaire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $compteBancaireRepository->save($compteBancaire, true);

            return $this->redirectToRoute('app_compte_bancaire_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('compte_bancaire/new.html.twig', [
            'compte_bancaire' => $compteBancaire,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_compte_bancaire_show', methods: ['GET'])]
    public function show(CompteBancaire $compteBancaire): Response
    {
        return $this->render('compte_bancaire/show.html.twig', [
            'compte_bancaire' => $compteBancaire,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_compte_bancaire_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, CompteBancaire $compteBancaire, CompteBancaireRepository $compteBancaireRepository): Response
    {
        $form = $this->createForm(CompteBancaireType::class, $compteBancaire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $compteBancaireRepository->save($compteBancaire, true);

            return $this->redirectToRoute('app_compte_bancaire_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('compte_bancaire/edit.html.twig', [
            'compte_bancaire' => $compteBancaire,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_compte_bancaire_delete', methods: ['POST'])]
    public function delete(Request $request, CompteBancaire $compteBancaire, CompteBancaireRepository $compteBancaireRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$compteBancaire->getId(), $request->request->get('_token'))) {
            $compteBancaireRepository->remove($compteBancaire, true);
        }

        return $this->redirectToRoute('app_compte_bancaire_index', [], Response::HTTP_SEE_OTHER);
    }
} 
