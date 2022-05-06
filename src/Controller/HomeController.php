<?php

namespace App\Controller;

use App\Form\SearchBarType;
use App\Repository\CommentRepository;
use App\Repository\GameRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(
        GameRepository $gameRepository, CommentRepository $commentRepository
    ): Response
    {
        return $this->render('home/index.html.twig', [
            'lastPublishedGames' => $gameRepository->findBy([], ['publishedAt' => 'DESC'], 9),
            'mostPlayedGames' => $gameRepository->getMostGameByOrderBy('SUM(lib.gameTime)'),
            'lastComments' => $commentRepository->findBy([], ['createdAt' => 'DESC'], 4), // simple find avec les bon params
            'mostBoughtGames' => $gameRepository->getMostGameByOrderBy('COUNT(lib.game)'),
        ]);
    }

    #[Route('/searchBar', name: 'app_search_bar')]
    public function searchBar(Request $request): Response {
        $formSearch = $this->createForm(SearchBarType::class);
        $formSearch->handleRequest($request);

        if ($formSearch->isSubmitted() && $formSearch->isValid()) {
            $value = $formSearch->getData()['search_value'];
            if ($value === null) {
                return $this->redirectToRoute('app_publisher');
            }
            // traiter les autres cas de figure !
            // Si ma valeur existe, alors je vais interroger le gameRepository
            // sur le name avec un LIKE %$value%
            // et si la réponse est égale à 1 => /jeux/{slug}
            // si réponse est > 1 => /jeux/rechercher/{$value}
            // si réponse = 0 => /jeux
            dd($value);
        }

        return $this->render('common/_searchbar.html.twig', [
            'formSearch' => $formSearch->createView(),
        ]);
    }

}
