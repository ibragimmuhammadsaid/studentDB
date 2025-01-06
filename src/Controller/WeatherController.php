<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Model\Weather;

class WeatherController extends AbstractController
{
    public function showWeather(): Response
    {
        $weather = new Weather();

        # Render
        return $this->render('weather/weather_widget.html.twig', [
            'weather' => $weather
        ]);
    }
}