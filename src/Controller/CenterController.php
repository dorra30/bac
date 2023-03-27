<?php

namespace App\Controller;

use App\Entity\Center;
use App\Form\CenterType;
use App\Repository\CenterRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/center')]
class CenterController extends AbstractController
{
    #[Route('/', name: 'app_center_index', methods: ['GET'])]
    public function index(CenterRepository $centerRepository): Response
    {
        return $this->render('center/index.html.twig', [
            'centers' => $centerRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_center_new', methods: ['GET', 'POST'])]
    public function new(Request $request, CenterRepository $centerRepository): Response
    {
        $center = new Center();
        $form = $this->createForm(CenterType::class, $center);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $centerRepository->save($center, true);

            return $this->redirectToRoute('app_center_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('center/new.html.twig', [
            'center' => $center,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_center_show', methods: ['GET'])]
    public function show(Center $center): Response
    {
        return $this->render('center/show.html.twig', [
            'center' => $center,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_center_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Center $center, CenterRepository $centerRepository): Response
    {
        $form = $this->createForm(CenterType::class, $center);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $centerRepository->save($center, true);

            return $this->redirectToRoute('app_center_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('center/edit.html.twig', [
            'center' => $center,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_center_delete', methods: ['POST'])]
    public function delete(Request $request, Center $center, CenterRepository $centerRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$center->getId(), $request->request->get('_token'))) {
            $centerRepository->remove($center, true);
        }

        return $this->redirectToRoute('app_center_index', [], Response::HTTP_SEE_OTHER);
    }
}
