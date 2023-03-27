<?php

namespace App\Controller;

use App\Entity\DateEp;
use App\Form\DateEpType;
use App\Repository\DateEpRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/date/ep')]
class DateEpController extends AbstractController
{
    #[Route('/', name: 'app_date_ep_index', methods: ['GET'])]
    public function index(DateEpRepository $dateEpRepository): Response
    {
        return $this->render('date_ep/index.html.twig', [
            'date_eps' => $dateEpRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_date_ep_new', methods: ['GET', 'POST'])]
    public function new(Request $request, DateEpRepository $dateEpRepository): Response
    {
        $dateEp = new DateEp();
        $form = $this->createForm(DateEpType::class, $dateEp);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $dateEpRepository->save($dateEp, true);

            return $this->redirectToRoute('app_date_ep_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('date_ep/new.html.twig', [
            'date_ep' => $dateEp,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_date_ep_show', methods: ['GET'])]
    public function show(DateEp $dateEp): Response
    {
        return $this->render('date_ep/show.html.twig', [
            'date_ep' => $dateEp,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_date_ep_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, DateEp $dateEp, DateEpRepository $dateEpRepository): Response
    {
        $form = $this->createForm(DateEpType::class, $dateEp);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $dateEpRepository->save($dateEp, true);

            return $this->redirectToRoute('app_date_ep_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('date_ep/edit.html.twig', [
            'date_ep' => $dateEp,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_date_ep_delete', methods: ['POST'])]
    public function delete(Request $request, DateEp $dateEp, DateEpRepository $dateEpRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$dateEp->getId(), $request->request->get('_token'))) {
            $dateEpRepository->remove($dateEp, true);
        }

        return $this->redirectToRoute('app_date_ep_index', [], Response::HTTP_SEE_OTHER);
    }
}
