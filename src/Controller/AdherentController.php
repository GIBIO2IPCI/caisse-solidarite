<?php

namespace App\Controller;

use App\Entity\Adherent;
use App\Form\AdherentType;
use App\Repository\AdherentRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Knp\Snappy\Pdf;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Routing\Annotation\Route;


#[Route('/admin/adherent')]
class AdherentController extends AbstractController
{
    #[Route('/', name: 'app_adherent_index', methods: ['GET'])]
    public function index(AdherentRepository $adherentRepository, Request $request, PaginatorInterface $paginator): Response
    {

        $adherent = $adherentRepository->findAll();
        $pagination = $paginator->paginate(
            $adherent,
            $request->query->getInt('page', 1),
            15
        );
        $q = $request->get("q");

        if ($q != null){
            $adherent = $adherentRepository->findBy(
                [
                    "nom" => $q,
                    ]
            );
        }

        return $this->render('adherent/index.html.twig', [
            'adherents' => $pagination,
        ]);
    }

    /**
     * @throws TransportExceptionInterface
     */
    #[Route('/new', name: 'app_adherent_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $adherent = new Adherent();
        $form = $this->createForm(AdherentType::class, $adherent);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($adherent);
            $entityManager->flush();

            return $this->redirectToRoute('app_adherent_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('adherent/new.html.twig', [
            'adherent' => $adherent,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_adherent_show', methods: ['GET'])]
    public function show(Adherent $adherent): Response
    {
        return $this->render('adherent/show.html.twig', [
            'adherent' => $adherent,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_adherent_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Adherent $adherent, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(AdherentType::class, $adherent);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_adherent_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('adherent/edit.html.twig', [
            'adherent' => $adherent,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_adherent_delete', methods: ['POST'])]
    public function delete(Request $request, Adherent $adherent, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$adherent->getId(), $request->request->get('_token'))) {
            $entityManager->remove($adherent);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_adherent_index', [], Response::HTTP_SEE_OTHER);
    }

    #[Route('/download/pdf', name: 'app_adherent_download_pdf', methods: ['GET'])]
    public function downloadPdf(AdherentRepository $adherentRepository, Pdf $pdf): Response
    {
        $adherents = $adherentRepository->findAll();
        $html = $this->renderView('adherent/pdf/liste.html.twig', ['adherents' => $adherents]);

        return new Response(
            $pdf->getOutputFromHtml($html, [
                'enable-local-file-access' => true,
                'orientation' => 'landscape',
                'footer-right' => '[page] / [toPage]',
                'footer-left' => 'Caisse de solidarité, liste des adhérents',
                'header-left' => 'Institut Pasteur de Côte d\'Ivoire',
                'header-right' => '[isodate] à [time]',
            ]),
            200,
            [
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => 'inline; filename="liste adherents.pdf"',
                'encoding' => 'utf-8',
            ]
        );
    }
}
