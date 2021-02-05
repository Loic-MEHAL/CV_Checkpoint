<?php

namespace App\Controller;

use App\Entity\Realisations;
use App\Form\RealisationsType;
use App\Repository\RealisationsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/realisations")
 */
class RealisationsController extends AbstractController
{
    /**
     * @Route("/", name="realisations_index", methods={"GET"})
     */
    public function index(RealisationsRepository $realisationsRepository): Response
    {
        return $this->render('realisations/index.html.twig', [
            'realisations' => $realisationsRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="realisations_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $realisation = new Realisations();
        $form = $this->createForm(RealisationsType::class, $realisation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($realisation);
            $entityManager->flush();

            return $this->redirectToRoute('realisations_index');
        }

        return $this->render('realisations/new.html.twig', [
            'realisation' => $realisation,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="realisations_show", methods={"GET"})
     */
    public function show(Realisations $realisation): Response
    {
        return $this->render('realisations/show.html.twig', [
            'realisation' => $realisation,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="realisations_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Realisations $realisation): Response
    {
        $form = $this->createForm(RealisationsType::class, $realisation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('realisations_index');
        }

        return $this->render('realisations/edit.html.twig', [
            'realisation' => $realisation,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="realisations_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Realisations $realisation): Response
    {
        if ($this->isCsrfTokenValid('delete'.$realisation->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($realisation);
            $entityManager->flush();
        }

        return $this->redirectToRoute('realisations_index');
    }
}
