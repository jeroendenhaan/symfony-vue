<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\Character;

class CharacterController extends AbstractController
{
    #[Route('/character', name: 'characters_index', methods: ['GET'])]
    public function index(ManagerRegistry $doctrine): Response
    {

        $characters = $doctrine
            ->getRepository(Character::class)
            ->findAll();

        $data = [];

        foreach ($characters as $character) {
            $data[] = [
                'id' => $character->getId(),
                'name' => $character->getName(),
                'race' => $character->getRace(),
                'age' => $character->getAge(),
            ];
        }

        return $this->json($data);
    }

    #[Route('/character/{id}', name: 'characters_show', methods: ['GET'])]
    public function show(ManagerRegistry $doctrine, int $id): Response
    {
        $character = $doctrine->getRepository(Character::class)->find($id);

        if (!$character) {

            return $this->json('No character found for id' . $id, 404);
        }

        $data =  [
            'id' => $character->getId(),
            'name' => $character->getName(),
            'race' => $character->getRace(),
            'age' => $character->getAge(),
        ];

        return $this->json($data);
    }

}
