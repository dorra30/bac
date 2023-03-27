<?php

namespace App\Controller;

use App\Entity\Directeur;
use App\Form\DirecteurType;
use App\Repository\DirecteurRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/directeur')]
class DirecteurController extends AbstractController
{
    #[Route('/', name: 'app_directeur_index', methods: ['GET'])]
    public function index(DirecteurRepository $directeurRepository): Response
    {
        return $this->render('directeur/index.html.twig', [
            'directeurs' => $directeurRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_directeur_new', methods: ['GET', 'POST'])]
    public function new(Request $request, DirecteurRepository $directeurRepository): Response
    {
        $directeur = new Directeur();
        $form = $this->createForm(DirecteurType::class, $directeur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $directeurRepository->save($directeur, true);

            return $this->redirectToRoute('app_directeur_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('directeur/new.html.twig', [
            'directeur' => $directeur,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_directeur_show', methods: ['GET'])]
    public function show(Directeur $directeur): Response
    {
        return $this->render('directeur/show.html.twig', [
            'directeur' => $directeur,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_directeur_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Directeur $directeur, DirecteurRepository $directeurRepository): Response
    {
        $form = $this->createForm(DirecteurType::class, $directeur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $directeurRepository->save($directeur, true);

            return $this->redirectToRoute('app_directeur_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('directeur/edit.html.twig', [
            'directeur' => $directeur,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_directeur_delete', methods: ['POST'])]
    public function delete(Request $request, Directeur $directeur, DirecteurRepository $directeurRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$directeur->getId(), $request->request->get('_token'))) {
            $directeurRepository->remove($directeur, true);
        }

        return $this->redirectToRoute('app_directeur_index', [], Response::HTTP_SEE_OTHER);
    }
}
