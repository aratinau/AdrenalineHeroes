<?php

namespace App\Controller;

use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AvailabilityController extends AbstractController
{
    /**
     * @Route("/api/availability", name="app_availability", methods={"POST"}))
     */
    public function availability(Request $request, ProductRepository $productRepository): JsonResponse
    {
        $datas = json_decode($request->getContent(),true);
        if (empty($datas["rent_from"]) || empty($datas["rent_to"])) {
            throw new Exception("You have to send a JSON body request with 'rent_from' and 'rent_to' value");
        }

        $from = new \DateTime($datas["rent_from"]);
        $to = new \DateTime($datas["rent_to"]);

        $products = $productRepository->getAvailableProducts($from, $to);

        return new JsonResponse($products);
    }
}
