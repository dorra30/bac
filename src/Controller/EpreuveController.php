<?php

namespace App\Controller;

use App\Entity\Epreuve;
use App\Form\EpreuveType;
use App\Repository\EpreuveRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/epreuve')]
class EpreuveController extends AbstractController
{
    #[Route('/', name: 'app_epreuve_index', methods: ['GET'])]
    public function index(EpreuveRepository $epreuveRepository): Response
    {
        return $this->render('epreuve/index.html.twig', [
            'epreuves' => $epreuveRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_epreuve_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EpreuveRepository $epreuveRepository): Response
    {
        $epreuve = new Epreuve();
        $form = $this->createForm(EpreuveType::class, $epreuve);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $epreuveRepository->save($epreuve, true);

            return $this->redirectToRoute('app_epreuve_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('epreuve/new.html.twig', [
            'epreuve' => $epreuve,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_epreuve_show', methods: ['GET'])]
    public function show(Epreuve $epreuve): Response
    {
        return $this->render('epreuve/show.html.twig', [
            'epreuve' => $epreuve,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_epreuve_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Epreuve $epreuve, EpreuveRepository $epreuveRepository): Response
    {
        $form = $this->createForm(EpreuveType::class, $epreuve);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $epreuveRepository->save($epreuve, true);

            return $this->redirectToRoute('app_epreuve_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('epreuve/edit.html.twig', [
            'epreuve' => $epreuve,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_epreuve_delete', methods: ['POST'])]
    public function delete(Request $request, Epreuve $epreuve, EpreuveRepository $epreuveRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$epreuve->getId(), $request->request->get('_token'))) {
            $epreuveRepository->remove($epreuve, true);
        }

        return $this->redirectToRoute('app_epreuve_index', [], Response::HTTP_SEE_OTHER);
    }
}
