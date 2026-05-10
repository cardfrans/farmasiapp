<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class BiteshipService
{
    protected $apiKey;
    protected $baseUrl;

    public function __construct()
    {
        $this->apiKey = config('services.biteship.api_key');
        $this->baseUrl = config('services.biteship.base_url');
    }

    // FITUR BARU: Mencari wilayah (Kecamatan/Kota)
    public function searchArea($query)
    {
        $response = Http::withHeaders([
            'Authorization' => $this->apiKey
        ])->get($this->baseUrl . 'maps/areas', [
            'countries' => 'id',
            'input' => $query,
            'type' => 'single'
        ]);

        return $response->json();
    }

    public function getRates($originId, $destinationId, $items, $couriers = 'jne,sicepat,jnt,anteraja,tiki,ninja,lion')
    {
        $response = Http::withHeaders([
            'Authorization' => $this->apiKey,
            'Content-Type' => 'application/json',
        ])->post($this->baseUrl . 'rates/couriers', [
            
            // PERBAIKAN DI SINI: Kembalikan menggunakan "area_id"
            'origin_area_id'      => $originId, 
            'destination_area_id' => $destinationId,
            
            'couriers'            => $couriers,
            'items'               => $items
        ]);

        return $response->json();
    }
}