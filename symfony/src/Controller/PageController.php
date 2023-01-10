<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PageController extends AbstractController
{
    #[Route('/')]
    public function home(): Response
    {
        $number = random_int(0, 100);

        return $this->render('pages/home.html.twig', [
            'number' => $number,
        ]);
    }

    #[Route('/api/test')]
    public function test(): Response
    {

    }

}