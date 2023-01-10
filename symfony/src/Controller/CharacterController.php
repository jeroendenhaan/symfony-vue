<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\Character;

class CharacterController extends AbstractController
{

    #[Route('/character', name: 'characters_index', methods: ['GET'])]
    public function index(Request $request, ManagerRegistry $doctrine): Response
    {

        $order = $this->_getOrderArray($request);

        $characters = $doctrine
            ->getRepository(Character::class)
            ->findBy([], $order);

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

            return $this->json('No character found for id ' . $id, 404);
        }

        $data = [
            'id' => $character->getId(),
            'name' => $character->getName(),
            'race' => $character->getRace(),
            'age' => $character->getAge(),
        ];

        return $this->json($data);
    }

    #[Route('/character/search/{q}', name: 'characters_search', methods: ['GET'])]
    public function search(Request $request, ManagerRegistry $doctrine, string $q): Response
    {
        $qb = $doctrine->getRepository(Character::class)
            ->createQueryBuilder('character')
            ->where('character.name LIKE :query')
            ->orWhere('character.race LIKE :query')
            ->setParameter('query', '%' . $q . '%');

        $order = $this->_getOrderArray($request);
        if (count($order)) {
            $key = array_key_first($order);
            $val = $order[$key];
            $qb->orderBy('character.' . $key, $val);
        }

        $characters = $qb->getQuery()->getResult();

        if (!$characters) {

            return $this->json('No characters found for query ' . $q, 404);
        }

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

    private function _getOrderArray(Request $request)
    {

        $order = [];
        if (!is_null($request->query->get('order'))) {
            $order[$request->query->get('order')] = 'asc';
            if (!is_null($request->query->get('dir')) && in_array($request->query->get('dir'), ['asc', 'desc'])) {
                $order[$request->query->get('order')] = $request->query->get('dir');
            }
        }

        return $order;

    }

}
