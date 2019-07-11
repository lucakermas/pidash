<?php

namespace App\Controller;

use App\Service\WeatherService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    /**
     * @Route("/", name="default")
     */
    public function indexAction(WeatherService $weatherService)
    {
        $name = getenv('NAME');

        return $this->render('index.html.twig', [
            'name' => $name,
            'weather' => $weatherService->getWeatherByCity('')
        ]);
    }
}