<?php

namespace App\Controller;

use App\Entity\BaremeFille;
use App\Form\BaremeFilleType;
use App\Repository\BaremeFilleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/bareme/fille')]
class BaremeFilleController extends AbstractController
{
    #[Route('/', name: 'app_bareme_fille_index', methods: ['GET'])]
    public function index(BaremeFilleRepository $baremeFilleRepository): Response
    {
        return $this->render('bareme_fille/index.html.twig', [
            'bareme_filles' => $baremeFilleRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_bareme_fille_new', methods: ['GET', 'POST'])]
    public function new(Request $request, BaremeFilleRepository $baremeFilleRepository): Response
    {
        $baremeFille = new BaremeFille();
        $form = $this->createForm(BaremeFilleType::class, $baremeFille);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $baremeFilleRepository->save($baremeFille, true);

            return $this->redirectToRoute('app_bareme_fille_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('bareme_fille/new.html.twig', [
            'bareme_fille' => $baremeFille,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_bareme_fille_show', methods: ['GET'])]
    public function show(BaremeFille $baremeFille): Response
    {
        return $this->render('bareme_fille/show.html.twig', [
            'bareme_fille' => $baremeFille,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_bareme_fille_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, BaremeFille $baremeFille, BaremeFilleRepository $baremeFilleRepository): Response
    {
        $form = $this->createForm(BaremeFilleType::class, $baremeFille);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $baremeFilleRepository->save($baremeFille, true);

            return $this->redirectToRoute('app_bareme_fille_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('bareme_fille/edit.html.twig', [
            'bareme_fille' => $baremeFille,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_bareme_fille_delete', methods: ['POST'])]
    public function delete(Request $request, BaremeFille $baremeFille, BaremeFilleRepository $baremeFilleRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$baremeFille->getId(), $request->request->get('_token'))) {
            $baremeFilleRepository->remove($baremeFille, true);
        }

        return $this->redirectToRoute('app_bareme_fille_index', [], Response::HTTP_SEE_OTHER);
    }
}
