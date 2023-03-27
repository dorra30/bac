<?php

namespace App\Controller;

use App\Entity\BaremeGarcon;
use App\Form\BaremeGarconType;
use App\Repository\BaremeGarconRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/bareme/garcon')]
class BaremeGarconController extends AbstractController
{
    #[Route('/', name: 'app_bareme_garcon_index', methods: ['GET'])]
    public function index(BaremeGarconRepository $baremeGarconRepository): Response
    {
        return $this->render('bareme_garcon/index.html.twig', [
            'bareme_garcons' => $baremeGarconRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_bareme_garcon_new', methods: ['GET', 'POST'])]
    public function new(Request $request, BaremeGarconRepository $baremeGarconRepository): Response
    {
        $baremeGarcon = new BaremeGarcon();
        $form = $this->createForm(BaremeGarconType::class, $baremeGarcon);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $baremeGarconRepository->save($baremeGarcon, true);

            return $this->redirectToRoute('app_bareme_garcon_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('bareme_garcon/new.html.twig', [
            'bareme_garcon' => $baremeGarcon,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_bareme_garcon_show', methods: ['GET'])]
    public function show(BaremeGarcon $baremeGarcon): Response
    {
        return $this->render('bareme_garcon/show.html.twig', [
            'bareme_garcon' => $baremeGarcon,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_bareme_garcon_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, BaremeGarcon $baremeGarcon, BaremeGarconRepository $baremeGarconRepository): Response
    {
        $form = $this->createForm(BaremeGarconType::class, $baremeGarcon);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $baremeGarconRepository->save($baremeGarcon, true);

            return $this->redirectToRoute('app_bareme_garcon_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('bareme_garcon/edit.html.twig', [
            'bareme_garcon' => $baremeGarcon,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_bareme_garcon_delete', methods: ['POST'])]
    public function delete(Request $request, BaremeGarcon $baremeGarcon, BaremeGarconRepository $baremeGarconRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$baremeGarcon->getId(), $request->request->get('_token'))) {
            $baremeGarconRepository->remove($baremeGarcon, true);
        }

        return $this->redirectToRoute('app_bareme_garcon_index', [], Response::HTTP_SEE_OTHER);
    }
}
