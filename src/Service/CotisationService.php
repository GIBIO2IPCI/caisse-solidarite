<?php

namespace App\Service;

use App\Entity\Cotisation;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;


readonly class CotisationService
{
    public function __construct(
        private EntityManagerInterface $entityManager,
        private MailService $mailService,
        private Security $security
    )
    {
    }


    /**
     * @throws TransportExceptionInterface
     */
    public function saveCotisation(Cotisation $cotisation): void
    {

        $user = $this->security->getUser();

        $cotisation->setUser($user);
        $this->entityManager->persist($cotisation);
        $this->entityManager->flush();
        $this->mailService->mailCotisation($cotisation->getAdherent()->getEmail());
    }

}