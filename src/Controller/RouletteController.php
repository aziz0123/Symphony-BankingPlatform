<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RouletteController extends AbstractController
{
    #[Route('/roulette', name: 'app_roulette')]
    public function spin(): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $cases = $entityManager->getRepository(RouletteCase::class)->findAll();
        $case = $cases[array_rand($cases)];
        return $this->render('roulette/index.html.twig', [
            'case' => $case,
        ]);
    }
}
