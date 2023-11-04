<?php

namespace App\Service;

use App\Entity\Cotisation;
use Knp\Snappy\Pdf;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

readonly class CotisationMailService
{

    public function __construct(
        private MailerInterface $mailer,
        private Environment     $twig,
        private Pdf             $pdf,

    )
    {
    }


    /**
     * @throws SyntaxError
     * @throws TransportExceptionInterface
     * @throws RuntimeError
     * @throws LoaderError
     */
    public function send($to, Cotisation $cotisation): void
    {

        $html = $this->twig->render('cotisation/pdf/recu.html.twig', ['cotisation' => $cotisation]);
        $pdf = $this->pdf->getOutputFromHtml($html, [
            'enable-local-file-access' => true,
            'orientation' => 'landscape',
            'page-size' => 'A5',
        ]);



        $email = (new Email())
            ->from('hello@example.com')
            ->to($to)
            //->cc('cc@example.com')
            //->bcc('bcc@example.com')
            //->replyTo('fabien@example.com')
            //->priority(Email::PRIORITY_HIGH)
            ->subject('Time for Symfony Mailer!')
            ->text('Sending emails is fun again!')
            ->html('<p>See Twig integration for better HTML integration!</p>')
            ->attach($pdf, 'paiement.pdf', 'application/pdf');


        $this->mailer->send($email);

    }

}