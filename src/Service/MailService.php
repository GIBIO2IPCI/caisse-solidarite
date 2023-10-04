<?php

namespace App\Service;

use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

readonly class MailService
{

    public function __construct(private MailerInterface $mailer)
    {
    }

    /**
     * @throws TransportExceptionInterface
     */
    public function mailAdhesion($adherent): void
    {
        $email = (new Email())
            ->from('hello@example.com')
            ->to($adherent)
            //->cc('cc@example.com')
            //->bcc('bcc@example.com')
            //->replyTo('fabien@example.com')
            //->priority(Email::PRIORITY_HIGH)
            ->subject('Time for Symfony Mailer!')
            ->text('Sending emails is fun again!')
            ->html('<p>See Twig integration for better HTML integration!</p>');

        $this->mailer->send($email);
    }

    /**
     * @throws TransportExceptionInterface
     */
    public function mailCotisation($adherent): void
    {
        $email = (new Email())
            ->from('hello@example.com')
            ->to($adherent)
            //->cc('cc@example.com')
            //->bcc('bcc@example.com')
            //->replyTo('fabien@example.com')
            //->priority(Email::PRIORITY_HIGH)
            ->subject('Time for Symfony Mailer!')
            ->text('Sending emails is fun again!')
            ->html('<p>See Twig integration for better HTML integration!</p>');

        $this->mailer->send($email);
    }

}