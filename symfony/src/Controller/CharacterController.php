<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\Query;
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

        // Initiate query builder
        $qb = $doctrine->getRepository(Character::class)
            ->createQueryBuilder('character');

        // Get order parameters if available and extend query accordingly
        $order = $this->_getOrderArray($request);
        if (count($order)) {
            $key = array_key_first($order);
            $val = $order[$key];
            $qb->orderBy('character.' . $key, $val);
        }

        // Execute query, get results as array
        $data = $qb->getQuery()->getResult(Query::HYDRATE_ARRAY);

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

        // Initiate query builder
        $qb = $doctrine->getRepository(Character::class)
            ->createQueryBuilder('character')
            ->where('character.id = :id')
            ->setParameter('id', $id);

        // Execute query, get results as array
        $data = $qb->getQuery()->getResult(Query::HYDRATE_ARRAY);

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

        $data = $qb->getQuery()->getResult(Query::HYDRATE_ARRAY);

        if (!$data) {
            return $this->json('No characters found for query ' . $q, 404);
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
        $paramOrder = $request->query->get('order');
        $paramDir = $request->query->get('dir');
        if (!is_null($paramOrder)) {
            $order[$paramOrder] = 'asc';
            if (!is_null($paramDir) && in_array($paramDir, ['asc', 'desc'])) {
                $order[$paramOrder] = $paramDir;
            }
        }

        return $order;

    }

}
