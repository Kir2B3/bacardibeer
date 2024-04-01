<?php

namespace App\Controller;

use App\Entity\Biere;
use App\Form\BiereType;
use App\Repository\BiereRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/biere')]
class BiereController extends AbstractController
{
    #[Route('/', name: 'app_biere_index', methods: ['GET'])]
    public function index(BiereRepository $biereRepository): Response
    {
        return $this->render('biere/index.html.twig', [
            'bieres' => $biereRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_biere_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $biere = new Biere();
        $form = $this->createForm(BiereType::class, $biere);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($biere);
            $entityManager->flush();

            return $this->redirectToRoute('app_biere_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('biere/new.html.twig', [
            'biere' => $biere,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_biere_show', methods: ['GET'])]
    public function show(Biere $biere): Response
    {
        return $this->render('biere/show.html.twig', [
            'biere' => $biere,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_biere_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Biere $biere, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(BiereType::class, $biere);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_biere_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('biere/edit.html.twig', [
            'biere' => $biere,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_biere_delete', methods: ['POST'])]
    public function delete(Request $request, Biere $biere, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$biere->getId(), $request->getPayload()->get('_token'))) {
            $entityManager->remove($biere);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_biere_index', [], Response::HTTP_SEE_OTHER);
    }
}
