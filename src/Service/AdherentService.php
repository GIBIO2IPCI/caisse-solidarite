<?php

namespace App\Service;

use App\Entity\Adherent;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;


readonly class AdherentService
{
    public function __construct(private EntityManagerInterface $entityManager, private MailService $mailService)
    {
    }


    /**
     * @throws TransportExceptionInterface
     */
    public function saveAdhrent(Adherent $adherent): void
    {
        $this->entityManager->persist($adherent);
        $this->entityManager->flush();
        $this->mailService->mailAdhesion($adherent->getEmail());
    }

}