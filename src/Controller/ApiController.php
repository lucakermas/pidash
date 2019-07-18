<?php

namespace App\Controller;

use App\Entity\RaspPiData;
use App\Service\WeatherService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
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

    /**
     * @Route("/rasppi/{piName}", name="api_rasppi_cpu", methods={"POST", "GET"})
     */
    public function raspPiCpuAction(Request $request, $piName)
    {
        $em = $this->getDoctrine()->getManager();

        /** @var RaspPiData|null $pi */
        $pi = $em->getRepository(RaspPiData::class)->findOneBy([
            'name' => $piName
        ]);

        if ($pi === null) {
            return new JsonResponse([
                'success' => false,
                'message' => "Pi $piName does not exist."
            ]);
        }

        if ($request->isMethod('POST')) {
            $temperature = $request->get('temperature');

            if (!empty($temperature)) {
                $pi->setCpuTemp(round($temperature, 1));

                $em->persist($pi);
                $em->flush();

                return new JsonResponse([
                    'success' => true,
                    'message' => "Temperature set."
                ]);
            }

            return new JsonResponse([
                'success' => false,
                'message' => "Please include the temperature."
            ]);
        }

        return new JsonResponse([
            'success' => true,
            'temperature' => $pi->getCpuTemp()
        ]);
    }
}