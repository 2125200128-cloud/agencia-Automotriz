<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class TopbarInfoController extends Controller
{
    public function show(Request $request)
    {
        $unavailable = 'No disponible';
        $geoData = $this->geoData($request->ip());
        $weatherData = $geoData ? $this->weatherData($geoData) : null;
        $exchangeRate = $this->exchangeRate();

        return response()->json([
            'location' => $geoData ? $this->formatLocation($geoData) : $unavailable,
            'temperature' => $weatherData['temperature'] ?? $unavailable,
            'humidity' => $weatherData['humidity'] ?? $unavailable,
            'rain' => $weatherData['rain'] ?? $unavailable,
            'exchange' => $exchangeRate ? '$'.number_format($exchangeRate, 2).' MXN' : $unavailable,
        ]);
    }

    private function geoData(?string $ip): ?array
    {
        $publicIp = $this->publicIp($ip);
        $providers = [
            [
                'url' => $publicIp ? "https://ipapi.co/{$publicIp}/json/" : 'https://ipapi.co/json/',
                'map' => fn (array $data) => [
                    'city' => $data['city'] ?? null,
                    'state' => $data['region'] ?? null,
                    'country' => $data['country_name'] ?? null,
                    'latitude' => $data['latitude'] ?? null,
                    'longitude' => $data['longitude'] ?? null,
                ],
            ],
            [
                'url' => $publicIp ? "https://get.geojs.io/v1/ip/geo/{$publicIp}.json" : 'https://get.geojs.io/v1/ip/geo.json',
                'map' => fn (array $data) => [
                    'city' => $data['city'] ?? null,
                    'state' => $data['region'] ?? null,
                    'country' => $data['country'] ?? null,
                    'latitude' => $data['latitude'] ?? null,
                    'longitude' => $data['longitude'] ?? null,
                ],
            ],
            [
                'url' => $publicIp ? "https://freeipapi.com/api/json/{$publicIp}" : 'https://freeipapi.com/api/json',
                'map' => fn (array $data) => [
                    'city' => $data['cityName'] ?? null,
                    'state' => $data['regionName'] ?? null,
                    'country' => $data['countryName'] ?? null,
                    'latitude' => $data['latitude'] ?? null,
                    'longitude' => $data['longitude'] ?? null,
                ],
            ],
            [
                'url' => $publicIp ? "https://ipinfo.io/{$publicIp}/json" : 'https://ipinfo.io/json',
                'map' => function (array $data) {
                    $coordinates = isset($data['loc']) ? explode(',', $data['loc']) : [];

                    return [
                        'city' => $data['city'] ?? null,
                        'state' => $data['region'] ?? null,
                        'country' => $data['country'] ?? null,
                        'latitude' => $coordinates[0] ?? null,
                        'longitude' => $coordinates[1] ?? null,
                    ];
                },
            ],
        ];

        foreach ($providers as $provider) {
            $data = $this->getJson($provider['url']);

            if (! $data) {
                continue;
            }

            $geoData = $provider['map']($data);

            if (! empty($geoData['latitude']) && ! empty($geoData['longitude'])) {
                return $geoData;
            }
        }

        return null;
    }

    private function publicIp(?string $ip): ?string
    {
        if (! $ip) {
            return null;
        }

        return filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) ? $ip : null;
    }

    private function weatherData(array $geoData): ?array
    {
        $data = $this->getJson('https://api.open-meteo.com/v1/forecast', [
            'latitude' => $geoData['latitude'],
            'longitude' => $geoData['longitude'],
            'current' => 'temperature_2m,relative_humidity_2m,precipitation',
            'timezone' => 'auto',
        ]);

        if (! $data) {
            return null;
        }

        $current = $data['current'] ?? [];
        $units = $data['current_units'] ?? [];

        return [
            'temperature' => $this->formatMetric($current['temperature_2m'] ?? null, $units['temperature_2m'] ?? 'C'),
            'humidity' => $this->formatMetric($current['relative_humidity_2m'] ?? null, $units['relative_humidity_2m'] ?? '%'),
            'rain' => $this->formatMetric($current['precipitation'] ?? null, $units['precipitation'] ?? 'mm'),
        ];
    }

    private function exchangeRate(): ?float
    {
        foreach ([
            'https://api.frankfurter.dev/v1/latest?base=USD&symbols=MXN',
            'https://api.frankfurter.app/latest?from=USD&to=MXN',
        ] as $url) {
            $data = $this->getJson($url);
            $rate = $data['rates']['MXN'] ?? null;

            if ($rate) {
                return (float) $rate;
            }
        }

        return null;
    }

    private function getJson(string $url, array $query = []): ?array
    {
        try {
            $response = Http::acceptJson()->timeout(5)->get($url, $query);

            if (! $response->successful()) {
                return null;
            }

            return $response->json();
        } catch (\Throwable) {
            return null;
        }
    }

    private function formatLocation(array $geoData): string
    {
        $parts = array_filter([
            $geoData['city'] ?? null,
            $geoData['state'] ?? null,
            $geoData['country'] ?? null,
        ]);

        return $parts ? implode(', ', $parts) : 'No disponible';
    }

    private function formatMetric($value, string $unit): ?string
    {
        if ($value === null || $value === '') {
            return null;
        }

        return $value.$unit;
    }
}
