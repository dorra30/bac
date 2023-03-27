<?php

namespace App\Controller;

use App\Entity\Essai;
use App\Form\EssaiType;
use App\Repository\EssaiRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/essai')]
class EssaiController extends AbstractController
{
    #[Route('/', name: 'app_essai_index', methods: ['GET'])]
    public function index(EssaiRepository $essaiRepository): Response
    {
        return $this->render('essai/index.html.twig', [
            'essais' => $essaiRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_essai_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EssaiRepository $essaiRepository): Response
    {
        $essai = new Essai();
        $form = $this->createForm(EssaiType::class, $essai);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $essaiRepository->save($essai, true);

            return $this->redirectToRoute('app_essai_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('essai/new.html.twig', [
            'essai' => $essai,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_essai_show', methods: ['GET'])]
    public function show(Essai $essai): Response
    {
        return $this->render('essai/show.html.twig', [
            'essai' => $essai,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_essai_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Essai $essai, EssaiRepository $essaiRepository): Response
    {
        $form = $this->createForm(EssaiType::class, $essai);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $essaiRepository->save($essai, true);

            return $this->redirectToRoute('app_essai_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('essai/edit.html.twig', [
            'essai' => $essai,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_essai_delete', methods: ['POST'])]
    public function delete(Request $request, Essai $essai, EssaiRepository $essaiRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$essai->getId(), $request->request->get('_token'))) {
            $essaiRepository->remove($essai, true);
        }

        return $this->redirectToRoute('app_essai_index', [], Response::HTTP_SEE_OTHER);
    }
}
