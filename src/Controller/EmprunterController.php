<?php

namespace App\Controller;

use App\Entity\Emprunter;
use App\Form\EmprunterType;
use App\Repository\EmprunterRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/emprunter")
 */
class EmprunterController extends AbstractController
{
    /**
     * @Route("/", name="emprunter_index", methods={"GET"})
     */
    public function index(EmprunterRepository $emprunterRepository): Response
    {
        return $this->render('emprunter/index.html.twig', [
            'emprunters' => $emprunterRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="emprunter_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $emprunter = new Emprunter();
        $form = $this->createForm(EmprunterType::class, $emprunter);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($emprunter);
            $entityManager->flush();

            return $this->redirectToRoute('emprunter_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('emprunter/new.html.twig', [
            'emprunter' => $emprunter,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="emprunter_show", methods={"GET"})
     */
    public function show(Emprunter $emprunter): Response
    {
        return $this->render('emprunter/show.html.twig', [
            'emprunter' => $emprunter,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="emprunter_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Emprunter $emprunter): Response
    {
        $form = $this->createForm(EmprunterType::class, $emprunter);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('emprunter_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('emprunter/edit.html.twig', [
            'emprunter' => $emprunter,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="emprunter_delete", methods={"POST"})
     */
    public function delete(Request $request, Emprunter $emprunter): Response
    {
        if ($this->isCsrfTokenValid('delete'.$emprunter->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($emprunter);
            $entityManager->flush();
        }

        return $this->redirectToRoute('emprunter_index', [], Response::HTTP_SEE_OTHER);
    }
}