<?php
// src/EventListener/ExpiringProductListener.php

namespace App\EventListener;

use App\Entity\Produit;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\Routing\RouterInterface;

class ExpiringProductListener extends AbstractController
{
    private EntityManagerInterface $entityManager;
    private RouterInterface $router;

    public function __construct(RouterInterface $router, EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->router = $router;
    }

    public function onKernelRequest(RequestEvent $event): void
    {
        $dateSeuil = new \DateTime('+5 days');
        $produits = $this->entityManager->getRepository(Produit::class)->findByDateExpiration($dateSeuil);

        if (!empty($produits)) {
            // Préparer le message flash
            $message = count($produits) > 1 ? 'Certains produits vont bientôt expirer : ' : 'Un produit va bientôt expirer : '.  $produits[0]->getDesignation();
            $this->addFlash('stock_exp', $message);

            return;
        }
    }
}
