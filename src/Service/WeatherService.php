<?php

namespace App\Service;

class WeatherService
{
    const ICONS = [
        'clear-day' => [
            'day' => 'wi-day-sunny',
            'night' => 'wi-night-clear'
        ],
        'clear-night' => [
            'day' => 'wi-day-sunny',
            'night' => 'wi-night-clear'
        ],
        'rain' => [
            'day' => 'wi-day-showers',
            'night' => 'wi-night-showers'
        ],
        'snow' => [
            'day' => 'wi-day-snow',
            'night' => 'wi-night-alt-snow'
        ],
        'sleet' => [
            'day' => 'wi-day-sleet',
            'night' => 'wi-night-alt-sleet'
        ],
        'wind' => [
            'day' => 'wi-day-windy',
            'night' => 'wi-night-alt-cloudy-gusts'
        ],
        'fog' => [
            'day' => 'wi-day-fog',
            'night' => 'wi-night-fog'
        ],
        'cloudy' => [
            'day' => 'wi-day-cloudy',
            'night' => 'wi-night-alt-cloudy'
        ],
        'partly-cloudy-day' => [
            'day' => 'wi-day-sunny-overcast',
            'night' => ''
        ],
        'partly-cloudy-night' => [
            'day' => 'wi-day-sunny-overcast',
            'night' => 'wi-night-alt-partly-cloudy'
        ],
    ];

    /**
     * https://api.darksky.net
     *
     * @param string $city
     */
    public function getWeatherByCity(string $city, $celsius = true)
    {
        $weatherData = [
            'time' => new \DateTime(),
            'temperature' => 0,
            'tempType' => 'F',
            'icon' => ''
        ];

        // TODO: Use Google API
        $lat = 52.52;
        $long = 14.404954;

        $key = getenv('WEATHER_API_KEY');
        $url = "https://api.darksky.net/forecast/$key/$lat,$long";

        // TODO: Check if curl is faster
        $result = json_decode(file_get_contents($url));
        $currentData = $result->currently;

        if ($celsius) {
            $weatherData['temperature'] = round(($currentData->temperature - 32) / 1.8, 1);
            $weatherData['tempType'] = 'C';
        } else {
            $weatherData['temperature'] = $currentData->temperature;
        }

        // Turn time in seconds into datetime & extract hour.
        $date = new \DateTime("@{$currentData->time}");
        $hour = (int)$date->format('H');

        $time = 'night';
        if ($hour > 6 && $hour < 20) {
            $time = 'day';
        }

        $icon = !empty(self::ICONS[$currentData->icon]) ? self::ICONS[$currentData->icon][$time] : 'wi-alien';

        $weatherData['icon'] = $icon;
        $weatherData['time'] = $date;
        
        return $weatherData;
    }
}
