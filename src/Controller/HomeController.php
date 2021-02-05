<?php


namespace App\Controller;


use App\Repository\CompetencesRepository;
use App\Repository\ParcoursRepository;
use App\Repository\RealisationsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(
        CompetencesRepository $competencesRepository,
        ParcoursRepository $parcoursRepository,
        RealisationsRepository $realisationsRepository): Response
    {
        $competences = $competencesRepository->findAll();
        $parcours = $parcoursRepository->findAll();
        $realisations = $realisationsRepository->findAll();

        return $this->render('home/index.html.twig', [
            'competences' => $competences,
            'parcours' => $parcours,
            'realisations' => $realisations
        ]);
    }
}