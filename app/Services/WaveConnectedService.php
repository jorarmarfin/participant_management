<?php

namespace App\Services;

use GuzzleHttp\Client;
class WaveConnectedService
{
    public function Call(string $method, string $url, array $options = []): bool|array
    {
        // Crear un nuevo cliente HTTP
        $client = new Client();
        try {
            $options['headers'] = [
                'Authorization' => 'Bearer ' . env('WAVECONNECTED_API_TOKEN'),
                'accept' => 'application/json',
                'content-type' => 'application/json',
            ];
            // Realizar la solicitud HTTP
            $uri = env('WAVECONNECTED_URL').'/api';
            $response = $client->request($method, $uri . $url, $options);
            // Decodificar la respuesta JSON a un array de PHP
            return json_decode($response->getBody(), true);
        } catch (RequestException $e) {
            Log::error('API Request failed', [
                'url' => $url,
                'method' => $method,
                'options' => $options,
                'exception' => $e->getMessage()
            ]);
            return false;
        }
    }

    /**
     * @param int $instance
     * @param string $phone
     * @return bool|array
     */
   public function getContactById(int $instance, string $phone): bool|array
    {
        $data = $this->Call('POST', '/get-contact-by-id', [
            'json' => [
                'instance' => $instance,
                'phone' => $phone
            ]
        ]);

        if (is_array($data) && array_key_exists('contact', $data)) {
            return $data['contact'];
        }

        return ['data' => ['isMyContact' => false]];
    }

}
