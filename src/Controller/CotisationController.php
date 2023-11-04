<?php

namespace App\Controller;

use App\Entity\Cotisation;
use App\Form\CotisationType;
use App\Repository\CotisationRepository;
use App\Service\CotisationMailService;
use App\Service\CotisationService;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Knp\Snappy\Pdf;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\WebpackEncoreBundle\Asset\EntrypointLookupInterface;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

#[Route('/admin/cotisation')]
class CotisationController extends AbstractController
{
    #[Route('/', name: 'app_cotisation_index', methods: ['GET'])]
    public function index(CotisationRepository $cotisationRepository, PaginatorInterface $paginator, Request $request): Response
    {
        $cotisation = $cotisationRepository->findAll();
        $pagination = $paginator->paginate(
            $cotisation, /* query NOT result */
            $request->query->getInt('page', 1), /*page number*/
            15 /*limit per page*/
        );

        return $this->render('cotisation/index.html.twig', [
            'cotisations' => $pagination,
        ]);
    }


    /**
     * @throws SyntaxError
     * @throws TransportExceptionInterface
     * @throws RuntimeError
     * @throws LoaderError
     */
    #[Route('/new', name: 'app_cotisation_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, CotisationMailService $cotisationMailService): Response
    {
        $cotisation = new Cotisation();
        $form = $this->createForm(CotisationType::class, $cotisation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $cotisation->setUser($this->getUser());
            $entityManager->persist($cotisation);
            $entityManager->flush();

            $cotisationMailService->send($cotisation->getAdherent()->getEmail(), $cotisation);

            return $this->redirectToRoute('app_cotisation_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('cotisation/new.html.twig', [
            'cotisation' => $cotisation,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_cotisation_show', methods: ['GET'])]
    public function show(Cotisation $cotisation): Response
    {
        return $this->render('cotisation/show.html.twig', [
            'cotisation' => $cotisation,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_cotisation_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Cotisation $cotisation, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(CotisationType::class, $cotisation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_cotisation_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('cotisation/edit.html.twig', [
            'cotisation' => $cotisation,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_cotisation_delete', methods: ['POST'])]
    public function delete(Request $request, Cotisation $cotisation, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$cotisation->getId(), $request->request->get('_token'))) {
            $entityManager->remove($cotisation);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_cotisation_index', [], Response::HTTP_SEE_OTHER);
    }

    #[Route('/download/liste/pdf', name: 'app_cotisation_liste_pdf', methods: ['GET'])]
    public function listPdf(CotisationRepository $cotisationRepository, Pdf $pdf): Response
    {
        $cotisations = $cotisationRepository->findAll();

        $html = $this->renderView('cotisation/pdf/liste.html.twig', ['cotisations' => $cotisations]);


        return new Response(
            $pdf->getOutputFromHtml($html, [
                'enable-local-file-access' => true,
                'orientation' => 'landscape',
                'footer-right' => '[page] / [toPage]',
                'footer-left' => 'Caisse de solidarité, liste des cotisations',
                'header-left' => 'Institut Pasteur de Côte d\'Ivoire',
                'header-right' => '[isodate] à [time]',
            ]),
            200,
            [
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => 'inline; filename="liste cotisations.pdf"',
                'encoding' => 'utf-8',
            ]
        );
    }

    #[Route('/download/paiement/{id}/pdf', name: 'app_cotisation_paiement_pdf', methods: ['GET'])]
    public function paiementPdf(CotisationRepository $cotisationRepository, Pdf $pdf, int $id): Response
    {
        $cotisation = $cotisationRepository->find($id);
        $html = $this->renderView('cotisation/pdf/recu.html.twig', ['cotisation' => $cotisation]);


        return new Response(
            $pdf->getOutputFromHtml($html, [
                'enable-local-file-access' => true,
                'orientation' => 'landscape',
                'page-size' => 'A5',
            ]),
            200,
            [
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => 'inline; filename="paiement de cotisations.pdf"',
                'encoding' => 'utf-8',
            ]
        );
    }
}
