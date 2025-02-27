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
        return $this->render('bidder/index.html.twig');
    }

    /**
     * API controller for bidder
     */
    #[Route('/api/bidder/{sVType}/{nBasicFee}', name: 'api_bidder')]
    public function api(string $sVType, string $nBasicFee): Response
    {
        $nBasicFee = floatval($nBasicFee);
        $variableCost = 0.1 * $nBasicFee;
        $maxValue = 50;
        $minValue = 10;
        $sellerFee = 0.02 * $nBasicFee;

        if ($sVType == 'Luxury') {
            $maxValue = 200;
            $minValue = 25;
            $sellerFee = 0.04 * $nBasicFee;
        }

        if ($variableCost < $minValue) {
            $variableCost = $minValue;
        } else if ($variableCost > $maxValue) {
            $variableCost = $maxValue;
        }

        $addedCost = 5.0;
        if ($nBasicFee <= 500){
            $addedCost = 5.0;
        } else if ($nBasicFee > 500 && $nBasicFee <= 1000){
            $addedCost = 10.0;
        } else if ($nBasicFee > 1000 && $nBasicFee <= 3000){
            $addedCost = 15.0;
        } else if ($nBasicFee > 3000){
            $addedCost = 20.0;
        }
        
        // TODO: fix for value of $nBasicFee = 0
        $totalFee = $nBasicFee + $variableCost + $sellerFee + $addedCost + 100.0;
        return new JsonResponse([
            'type' => $sVType,
            'basicFee' => $nBasicFee,
            'variableCost' => $variableCost,
            'sellerFee' => $sellerFee,
            'addedCost' => $addedCost,
            'storageFee' => 100.0,
            'totalCost' => $totalFee
        ]);
    }
}
