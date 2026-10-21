<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

class CoffeeShopsController
{
    #[Route('/coffee_shops')]
    public function index(Request $request): JsonResponse
    {
        $x = (float) $request->query->get('x');
        $y = (float) $request->query->get('y');

        $csv = file_get_contents('https://static.reasig.ro/interview/coffee_shops_exerceise/coffee_shops.csv');

        $shops = [];
        foreach (explode("\n", trim($csv)) as $line) {
            $row = str_getcsv($line, ',', '"', '');
            if (count($row) < 3 || !is_numeric($row[1]) || !is_numeric($row[2])) {
                continue;
            }
            $shopX = (float) $row[1];
            $shopY = (float) $row[2];
            $distance = sqrt(($x - $shopX) ** 2 + ($y - $shopY) ** 2);
            $shops[] = ['name' => $row[0], 'x' => $shopX, 'y' => $shopY, 'distance' => round($distance, 4)];
        }

        usort($shops, fn ($a, $b) => $a['distance'] <=> $b['distance']);

        return new JsonResponse(array_slice($shops, 0, 3));
    }
}
