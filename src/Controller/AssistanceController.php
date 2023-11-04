<?php

namespace App\Controller;

use App\Entity\Assistance;
use App\Form\AssistanceType;
use App\Repository\AssistanceRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Knp\Snappy\Pdf;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/assistance')]
class AssistanceController extends AbstractController
{
    #[Route('/', name: 'app_assistance_index', methods: ['GET'])]
    public function index(AssistanceRepository $assistanceRepository, Request $request, PaginatorInterface $paginator): Response
    {
        $assistances = $assistanceRepository->findAll();
        $pagination = $paginator->paginate(
            $assistances,
            $request->query->getInt('page', 1),
            15
        );

        return $this->render('assistance/index.html.twig', [
            'assistances' => $pagination,
        ]);
    }

    #[Route('/new', name: 'app_assistance_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $assistance = new Assistance();
        $form = $this->createForm(AssistanceType::class, $assistance);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($assistance);
            $entityManager->flush();

            return $this->redirectToRoute('app_assistance_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('assistance/new.html.twig', [
            'assistance' => $assistance,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_assistance_show', methods: ['GET'])]
    public function show(Assistance $assistance): Response
    {
        return $this->render('assistance/show.html.twig', [
            'assistance' => $assistance,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_assistance_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Assistance $assistance, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(AssistanceType::class, $assistance);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_assistance_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('assistance/edit.html.twig', [
            'assistance' => $assistance,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_assistance_delete', methods: ['POST'])]
    public function delete(Request $request, Assistance $assistance, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$assistance->getId(), $request->request->get('_token'))) {
            $entityManager->remove($assistance);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_assistance_index', [], Response::HTTP_SEE_OTHER);
    }

    #[Route('/download/pdf', name: 'app_assistance_liste_pdf', methods: ['GET'])]
    public function downloadPdf(AssistanceRepository $assistanceRepository, Pdf $pdf): Response
    {
        $assistances = $assistanceRepository->findAll();

        $html = $this->renderView('assistance/pdf/liste.html.twig', ['assistances' => $assistances]);


        return new Response(
            $pdf->getOutputFromHtml($html, [
                'enable-local-file-access' => true,
                'orientation' => 'landscape',
                'footer-right' => '[page] / [toPage]',
                'footer-left' => 'Caisse de solidarité, liste des assistances',
                'header-left' => 'Institut Pasteur de Côte d\'Ivoire',
                'header-right' => '[isodate] à [time]',
            ]),
            200,
            [
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => 'inline; filename="liste assistance.pdf"',
                'encoding' => 'utf-8',
            ]
        );
    }
}
