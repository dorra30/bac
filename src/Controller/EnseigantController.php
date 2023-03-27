<?php

namespace App\Controller;

use App\Entity\Enseigant;
use App\Form\EnseigantType;
use App\Repository\EnseigantRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/enseigant')]
class EnseigantController extends AbstractController
{
    #[Route('/', name: 'app_enseigant_index', methods: ['GET'])]
    public function index(EnseigantRepository $enseigantRepository): Response
    {
        return $this->render('enseigant/index.html.twig', [
            'enseigants' => $enseigantRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_enseigant_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EnseigantRepository $enseigantRepository): Response
    {
        $enseigant = new Enseigant();
        $form = $this->createForm(EnseigantType::class, $enseigant);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $enseigantRepository->save($enseigant, true);

            return $this->redirectToRoute('app_enseigant_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('enseigant/new.html.twig', [
            'enseigant' => $enseigant,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_enseigant_show', methods: ['GET'])]
    public function show(Enseigant $enseigant): Response
    {
        return $this->render('enseigant/show.html.twig', [
            'enseigant' => $enseigant,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_enseigant_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Enseigant $enseigant, EnseigantRepository $enseigantRepository): Response
    {
        $form = $this->createForm(EnseigantType::class, $enseigant);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $enseigantRepository->save($enseigant, true);

            return $this->redirectToRoute('app_enseigant_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('enseigant/edit.html.twig', [
            'enseigant' => $enseigant,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_enseigant_delete', methods: ['POST'])]
    public function delete(Request $request, Enseigant $enseigant, EnseigantRepository $enseigantRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$enseigant->getId(), $request->request->get('_token'))) {
            $enseigantRepository->remove($enseigant, true);
        }

        return $this->redirectToRoute('app_enseigant_index', [], Response::HTTP_SEE_OTHER);
    }
}
