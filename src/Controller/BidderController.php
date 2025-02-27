<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

final class BidderController extends AbstractController
{
    #[Route('/', name: 'app_bidder')]
    public function index(): Response
    {
        return $this->render('bidder/index.html.twig', [
            'controller_name' => 'BidderController',
        ]);
    }

    #[Route('/api/bidder/{vehicleType}', name: 'app_bidder_show')]
    public function api(string $vehicleType): Response
    {
        return new JsonResponse( "vehicle Type: " . $vehicleType);
    }
}
