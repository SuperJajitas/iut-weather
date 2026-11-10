<?php

namespace App\Http\Controllers;

use App\Services\OpenWeatherService;
use Illuminate\Http\Request;

class WeatherController extends Controller
{
    public function index(Request $request, OpenWeatherService $weatherService)
    {
        $city = $request->query('city');

        $coordinates = null;
        $weather = null;
        $forecast = null;

        if ($city) {
            $coordinates = $weatherService->getCityCoordinates($city);

            if ($coordinates) {
                $weather = $weatherService->getCurrentWeatherByCoordinates(
                    $coordinates['latitude'],
                    $coordinates['longitude']
                );

                $forecastData = $weatherService->getForecastByCoordinates(
                    $coordinates['latitude'],
                    $coordinates['longitude']
                );

                $forecast = $weatherService->getDailyForecast($forecastData);
            }
        }

        return view('weather', compact('city', 'coordinates', 'weather', 'forecast'));
    }
}
