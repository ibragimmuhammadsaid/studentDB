<?php

namespace App\Model;

use Composer\Util\Http\Response;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class Weather
{
    private float $temperature = 0.0;

    public function __construct(
        #HttpClientInterface $client,   
    ) {
        #$response = $client->request('GET', 'https://api.open-meteo.com/v1/forecast?latitude=41.2647&longitude=69.2163&current=temperature_2m');
        #$weatherData = $response->toArray();
        #$this->temperature = $weatherData['current']['temperature_2m'];
        $this->temperature = -2.3;
    }

    public function getTemp(): float
    {
        return $this->temperature;
    }

    public function getStatus(): string
    {
        if ($this->temperature >= 15.0) {
            return 'images/hot.png';
        } else if ($this->temperature < 0) {
            return 'images/cold.png';
        } else {
            return 'images/warm.png';
        }
    }
}