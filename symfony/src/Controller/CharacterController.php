<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\Character;


/**
 * Class CharacterController
 *
 * Provides restful endpoints for a bunch of characters in our MySQL database.
 */
#[Route('/api/character', name: 'api_character_')]
class CharacterController extends AbstractController
{

    /**
     * Fetches all rows and returns them in JSON format.
     *
     * @param Request $request
     * @param ManagerRegistry $doctrine
     * @return Response
     */
    #[Route('/', name: 'characters_index', methods: ['GET'])]
    public function index(Request $request, ManagerRegistry $doctrine): Response
    {

        $order = $this->_getOrderArray($request);

        $characters = $doctrine
            ->getRepository(Character::class)
            ->findBy([], $order);

        $data = [];
        foreach ($characters as $character) {
            $data[] = $character->getArray();
        }

        return $this->json($data);
    }

    /**
     * Fetches and returns a single entry.
     *
     * @param ManagerRegistry $doctrine
     * @param int $id
     * @return Response
     */
    #[Route('/{id}', name: 'characters_show', methods: ['GET'])]
    public function show(ManagerRegistry $doctrine, int $id): Response
    {
        $character = $doctrine->getRepository(Character::class)->find($id);

        if (!$character) {

            return $this->json('No character found for id ' . $id, 404);
        }

        $data = $character->getArray();

        return $this->json($data);
    }

    /**
     * Performs a '%LIKE%' search on columns name and race for the given query parameter.
     *
     * @param Request $request
     * @param ManagerRegistry $doctrine
     * @param string $q
     * @return Response
     */
    #[Route('/search/{q}', name: 'characters_search', methods: ['GET'])]
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
            $data[] = $character->getArray();
        }

        return $this->json($data);
    }

    /**
     * Examines the current request for 'order' and 'dir' parameters and creates/returns an array accordingly.
     *
     * @param Request $request
     * @return array
     */
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
