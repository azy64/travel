<?php

namespace App\Controller;

use App\Entity\Voyages;
use App\Form\VoyagesType;
use App\Repository\VoyagesRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class VoyagesController extends AbstractController
{
    /**
     * @Route("/", name="app_voyages_index", methods={"GET"})
     */
    public function index(ManagerRegistry $entityManager): Response
    {
        $voyages = $entityManager
            ->getRepository(Voyages::class)
            ->findAll();

        return $this->render('voyages/index.html.twig', [
            'voyages' => $voyages,
        ]);
    }

    /**
     * @Route("/new", name="app_voyages_new", methods={"GET", "POST"})
     */
    public function new(Request $request): Response
    {
        $voyage = new Voyages();
        $form = $this->createForm(VoyagesType::class, $voyage);
        $form->handleRequest($request);
        $ent = $this->getDoctrine()->getManager();

        if ($form->isSubmitted() && $form->isValid()) {
           // dd($ent);
            $ent->persist($voyage);
            $ent->flush();

            return $this->redirectToRoute('app_voyages_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('voyages/new.html.twig', [
            'voyage' => $voyage,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/show/{id}", name="app_voyages_show", methods={"GET"})
     */
    public function show(Voyages $voyage): Response
    {
        return $this->render('voyages/show.html.twig', [
            'voyage' => $voyage,
        ]);
    }

    /**
     * @Route("/edit/{id}", name="app_voyages_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Voyages $voyage): Response
    {
        $form = $this->createForm(VoyagesType::class, $voyage);
        $form->handleRequest($request);
        $entityManager = $this->getDoctrine()->getManager();

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_voyages_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('voyages/edit.html.twig', [
            'voyage' => $voyage,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/delete/{id}", name="app_voyages_delete", methods={"POST"})
     */
    public function delete(Request $request, Voyages $voyage, ManagerRegistry $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$voyage->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($voyage);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_voyages_index', [], Response::HTTP_SEE_OTHER);
    }
}
