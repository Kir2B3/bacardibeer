<?php

namespace App\Controller;

use App\Entity\Bar;
use App\Form\BarType;
use App\Repository\BarRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/bar')]
class BarController extends AbstractController
{
    #[Route('/', name: 'app_bar_index', methods: ['GET'])]
    public function index(BarRepository $barRepository): Response
    {
        return $this->render('bar/index.html.twig', [
            'bars' => $barRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_bar_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $bar = new Bar();
        $form = $this->createForm(BarType::class, $bar);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($bar);
            $entityManager->flush();

            return $this->redirectToRoute('app_bar_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('bar/new.html.twig', [
            'bar' => $bar,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_bar_show', methods: ['GET'])]
    public function show(Bar $bar): Response
    {
        return $this->render('bar/show.html.twig', [
            'bar' => $bar,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_bar_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Bar $bar, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(BarType::class, $bar);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_bar_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('bar/edit.html.twig', [
            'bar' => $bar,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_bar_delete', methods: ['POST'])]
    public function delete(Request $request, Bar $bar, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$bar->getId(), $request->getPayload()->get('_token'))) {
            $entityManager->remove($bar);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_bar_index', [], Response::HTTP_SEE_OTHER);
    }
}
