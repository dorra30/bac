<?php

namespace App\Controller;

use App\Entity\Assistant;
use App\Form\AssistantType;
use App\Repository\AssistantRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/assistant')]
class AssistantController extends AbstractController
{
    #[Route('/', name: 'app_assistant_index', methods: ['GET'])]
    public function index(AssistantRepository $assistantRepository): Response
    {
        return $this->render('assistant/index.html.twig', [
            'assistants' => $assistantRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_assistant_new', methods: ['GET', 'POST'])]
    public function new(Request $request, AssistantRepository $assistantRepository): Response
    {
        $assistant = new Assistant();
        $form = $this->createForm(AssistantType::class, $assistant);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $assistantRepository->save($assistant, true);

            return $this->redirectToRoute('app_assistant_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('assistant/new.html.twig', [
            'assistant' => $assistant,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_assistant_show', methods: ['GET'])]
    public function show(Assistant $assistant): Response
    {
        return $this->render('assistant/show.html.twig', [
            'assistant' => $assistant,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_assistant_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Assistant $assistant, AssistantRepository $assistantRepository): Response
    {
        $form = $this->createForm(AssistantType::class, $assistant);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $assistantRepository->save($assistant, true);

            return $this->redirectToRoute('app_assistant_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('assistant/edit.html.twig', [
            'assistant' => $assistant,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_assistant_delete', methods: ['POST'])]
    public function delete(Request $request, Assistant $assistant, AssistantRepository $assistantRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$assistant->getId(), $request->request->get('_token'))) {
            $assistantRepository->remove($assistant, true);
        }

        return $this->redirectToRoute('app_assistant_index', [], Response::HTTP_SEE_OTHER);
    }
}
