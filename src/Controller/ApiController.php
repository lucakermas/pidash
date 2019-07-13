<?php

namespace App\Controller;

use App\Service\WeatherService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class ApiController
 *
 * @package App\Controller
 *
 * @Route("/api")
 */
class ApiController extends AbstractController
{
    /**
     * @Route("/weather/{city}", name="api_get_weather", methods={"GET"})
     */
    public function weatherAction(string $city, WeatherService $weatherService)
    {
        $weatherData = $weatherService->getWeatherByCity($city);

        return new JsonResponse($weatherData);
    }
}