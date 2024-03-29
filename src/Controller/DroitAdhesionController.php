<?php

namespace App\Controller;

use App\Entity\DroitAdhesion;
use App\Form\DroitAdhesionType;
use App\Repository\DroitAdhesionRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Knp\Snappy\Pdf;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/droit/adhesion')]
class DroitAdhesionController extends AbstractController
{
    #[Route('/', name: 'app_droit_adhesion_index', methods: ['GET'])]
    public function index(DroitAdhesionRepository $droitAdhesionRepository, PaginatorInterface $paginator, Request $request): Response
    {
        $adhesion = $droitAdhesionRepository->findAll();
        $pagination = $paginator->paginate(
            $adhesion, /* query NOT result */
            $request->query->getInt('page', 1), /*page number*/
            15 /*limit per page*/
        );

        return $this->render('droit_adhesion/index.html.twig', [
            'droit_adhesions' => $pagination,
        ]);
    }

    #[Route('/new', name: 'app_droit_adhesion_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $droitAdhesion = new DroitAdhesion();
        $form = $this->createForm(DroitAdhesionType::class, $droitAdhesion);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($droitAdhesion);
            $entityManager->flush();

            return $this->redirectToRoute('app_droit_adhesion_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('droit_adhesion/new.html.twig', [
            'droit_adhesion' => $droitAdhesion,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_droit_adhesion_show', methods: ['GET'])]
    public function show(DroitAdhesion $droitAdhesion): Response
    {
        return $this->render('droit_adhesion/show.html.twig', [
            'droit_adhesion' => $droitAdhesion,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_droit_adhesion_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, DroitAdhesion $droitAdhesion, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(DroitAdhesionType::class, $droitAdhesion);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_droit_adhesion_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('droit_adhesion/edit.html.twig', [
            'droit_adhesion' => $droitAdhesion,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_droit_adhesion_delete', methods: ['POST'])]
    public function delete(Request $request, DroitAdhesion $droitAdhesion, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$droitAdhesion->getId(), $request->request->get('_token'))) {
            $entityManager->remove($droitAdhesion);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_droit_adhesion_index', [], Response::HTTP_SEE_OTHER);
    }

    #[Route('/download/pdf', name: 'app_adhesion_liste_pdf', methods: ['GET'])]
    public function downloadPdf(DroitAdhesionRepository $droitAdhesionRepository, Pdf $pdf): Response
    {
        $adhesions = $droitAdhesionRepository->findAll();

        $html = $this->renderView('droit_adhesion/pdf/liste.html.twig', ['adhesions' => $adhesions]);


        return new Response(
            $pdf->getOutputFromHtml($html, [
                'enable-local-file-access' => true,
                'orientation' => 'landscape',
                'footer-right' => '[page] / [toPage]',
                'footer-left' => 'Caisse de solidarité, liste des adhésions',
                'header-left' => 'Institut Pasteur de Côte d\'Ivoire',
                'header-right' => '[isodate] à [time]',

            ]),
            200,
            [
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => 'inline; filename="liste adhesions.pdf"',
                'encoding' => 'utf-8',
            ]
        );
    }
}
