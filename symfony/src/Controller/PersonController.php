<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\Person;

class PersonController extends AbstractController
{
    #[Route('/person', name: 'app_person')]
    public function index(ManagerRegistry $doctrine): Response
    {

        $data = $doctrine->getRepository(Person::class)->findAll();

        return $this->render('person/index.html.twig', [
            'data' => $data,
        ]);
    }

}
