<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class OpenWeatherService
{
    public function getCurrentWeather(string $city)
    {
        $response = Http::get('https://api.openweathermap.org/data/2.5/weather', [
            'q' => $city . ',FR',
            'appid' => config('services.openweather.key'),
            'units' => 'metric',
            'lang' => 'fr',
        ]);

        $response->throw();

        return $response->json();
    }


    public function searchCities(string $city)
    {
        $response = Http::get('https://api.openweathermap.org/geo/1.0/direct', [
            'q' => $city,
            'limit' => 5,
            'appid' => config('services.openweather.key'),
    ]);

    $response->throw();

    return $response->json();
    }


    public function getCityCoordinates(string $city)
    {
        $cities = $this->searchCities($city);

        if (empty($cities)) {
            return null;
        }

        return [
            'name' => $cities[0]['name'],
            'country' => $cities[0]['country'],
            'latitude' => $cities[0]['lat'],
            'longitude' => $cities[0]['lon'],
        ];
    }


    public function getCurrentWeatherByCoordinates(float $latitude, float $longitude)
    {
        $response = Http::get('https://api.openweathermap.org/data/2.5/weather', [
            'lat' => $latitude,
            'lon' => $longitude,
            'appid' => config('services.openweather.key'),
            'units' => 'metric',
            'lang' => 'fr',
        ]);

        $response->throw();

        return $response->json();
    }


    public function getForecastByCoordinates(float $latitude, float $longitude)
    {
        $response = Http::get('https://api.openweathermap.org/data/2.5/forecast', [
            'lat' => $latitude,
            'lon' => $longitude,
            'appid' => config('services.openweather.key'),
            'units' => 'metric',
            'lang' => 'fr',
        ]);

        $response->throw();

        return $response->json();
    }


    public function groupForecastByDay(array $forecast): array
    {
        $groupedForecast = [];

        foreach ($forecast['list'] as $item) {
            $date = substr($item['dt_txt'], 0, 10);

            if (!isset($groupedForecast[$date])) {
                $groupedForecast[$date] = [];
            }

            $groupedForecast[$date][] = $item;
        }

        return $groupedForecast;
    }


    public function getDailyForecast(array $forecast): array
    {
        $groupedForecast = $this->groupForecastByDay($forecast);

        $dailyForecast = [];

        foreach ($groupedForecast as $date => $items) {
            $selectedForecast = null;
            $smallestDifference = PHP_INT_MAX;

            foreach ($items as $item) {
                $hour = (int) substr($item['dt_txt'], 11, 2);
                $difference = abs($hour - 12);

                if ($difference < $smallestDifference) {
                    $smallestDifference = $difference;
                    $selectedForecast = $item;
                }
            }

            $dailyForecast[$date] = $selectedForecast;
        }

        return $dailyForecast;
    }


}
