<?php

namespace App\Controller;

use App\Repository\FilmRepository;
use App\Repository\PersonnageRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(FilmRepository $filmRepository, PersonnageRepository $personnageRepository)
    {

        $listFilm = $filmRepository->findByFilmLimit();
        $listPersonnage = $personnageRepository->findAll();
        dump($listPersonnage);
        return $this->render('home/index.html.twig', [
            'listFilm' => $listFilm,
            'listPersonnage' => $listPersonnage
        ]);
    }
}