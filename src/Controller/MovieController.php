<?php

namespace App\Controller;

use App\Entity\Movie;
use App\Repository\MovieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class MovieController extends AbstractController
{
    /**
     * @Route("/movie", name="movie")
     */
    public function index(MovieRepository $movieRepository)
    {
        $movies = $movieRepository->findAllWihArtists();
        return $this->render('movie/index.html.twig', [
            'controller_name' => 'movieController',
            'movies' => $movies,
        ]);
    }
}
