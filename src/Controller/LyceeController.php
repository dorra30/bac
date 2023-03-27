<?php

namespace App\Controller;

use App\Entity\Lycee;
use App\Form\LyceeType;
use App\Repository\LyceeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/lycee')]
class LyceeController extends AbstractController
{
    #[Route('/', name: 'app_lycee_index', methods: ['GET'])]
    public function index(LyceeRepository $lyceeRepository): Response
    {
        return $this->render('lycee/index.html.twig', [
            'lycees' => $lyceeRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_lycee_new', methods: ['GET', 'POST'])]
    public function new(Request $request, LyceeRepository $lyceeRepository): Response
    {
        $lycee = new Lycee();
        $form = $this->createForm(LyceeType::class, $lycee);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $lyceeRepository->save($lycee, true);

            return $this->redirectToRoute('app_lycee_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('lycee/new.html.twig', [
            'lycee' => $lycee,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_lycee_show', methods: ['GET'])]
    public function show(Lycee $lycee): Response
    {
        return $this->render('lycee/show.html.twig', [
            'lycee' => $lycee,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_lycee_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Lycee $lycee, LyceeRepository $lyceeRepository): Response
    {
        $form = $this->createForm(LyceeType::class, $lycee);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $lyceeRepository->save($lycee, true);

            return $this->redirectToRoute('app_lycee_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('lycee/edit.html.twig', [
            'lycee' => $lycee,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_lycee_delete', methods: ['POST'])]
    public function delete(Request $request, Lycee $lycee, LyceeRepository $lyceeRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$lycee->getId(), $request->request->get('_token'))) {
            $lyceeRepository->remove($lycee, true);
        }

        return $this->redirectToRoute('app_lycee_index', [], Response::HTTP_SEE_OTHER);
    }
}
