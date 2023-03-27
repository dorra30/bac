<?php

namespace App\Controller;

use App\Entity\Coordinateur;
use App\Form\CoordinateurType;
use App\Repository\CoordinateurRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/coordinateur')]
class CoordinateurController extends AbstractController
{
    #[Route('/', name: 'app_coordinateur_index', methods: ['GET'])]
    public function index(CoordinateurRepository $coordinateurRepository): Response
    {
        return $this->render('coordinateur/index.html.twig', [
            'coordinateurs' => $coordinateurRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_coordinateur_new', methods: ['GET', 'POST'])]
    public function new(Request $request, CoordinateurRepository $coordinateurRepository): Response
    {
        $coordinateur = new Coordinateur();
        $form = $this->createForm(CoordinateurType::class, $coordinateur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $coordinateurRepository->save($coordinateur, true);

            return $this->redirectToRoute('app_coordinateur_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('coordinateur/new.html.twig', [
            'coordinateur' => $coordinateur,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_coordinateur_show', methods: ['GET'])]
    public function show(Coordinateur $coordinateur): Response
    {
        return $this->render('coordinateur/show.html.twig', [
            'coordinateur' => $coordinateur,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_coordinateur_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Coordinateur $coordinateur, CoordinateurRepository $coordinateurRepository): Response
    {
        $form = $this->createForm(CoordinateurType::class, $coordinateur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $coordinateurRepository->save($coordinateur, true);

            return $this->redirectToRoute('app_coordinateur_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('coordinateur/edit.html.twig', [
            'coordinateur' => $coordinateur,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_coordinateur_delete', methods: ['POST'])]
    public function delete(Request $request, Coordinateur $coordinateur, CoordinateurRepository $coordinateurRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$coordinateur->getId(), $request->request->get('_token'))) {
            $coordinateurRepository->remove($coordinateur, true);
        }

        return $this->redirectToRoute('app_coordinateur_index', [], Response::HTTP_SEE_OTHER);
    }
}
