<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\BiteshipService;
use Illuminate\Support\Facades\Log; // Tambahkan ini untuk mencatat error

class ShippingController extends Controller
{
    protected $biteship;

    // PASTIKAN CONSTRUCTOR INI ADA
    public function __construct(BiteshipService $biteship)
    {
        $this->biteship = $biteship;
    }

    public function index()
    {
        return view('shipping.index');
    }

    public function search(Request $request)
    {
        try {
            $query = $request->get('q');
            
            // Panggil fungsi searchArea dari service
            $result = $this->biteship->searchArea($query);

            $formatted = [];
            
            // Pastikan data 'areas' benar-benar ada dari Biteship
            if (isset($result['areas']) && is_array($result['areas'])) {
                foreach ($result['areas'] as $area) {
                    // Gunakan null coalescing (??) agar tidak error jika ada data kota yang kosong
                    $name = $area['name'] ?? '';
                    $city = $area['city_name'] ?? '';
                    $prov = $area['administrative_division_name'] ?? '';
                    $zip = $area['postal_code'] ?? '';

                    $formatted[] = [
                        'id' => $area['id'],
                        'text' => strtoupper("$name, $city, $prov, $zip")
                    ];
                }
            }

            return response()->json($formatted);

        } catch (\Exception $e) {
            // Jika ada error, catat di log laravel dan kembalikan response kosong
            Log::error("Biteship Search Error: " . $e->getMessage());
            return response()->json([]);
        }
    }

    public function check(Request $request)
    {
        $request->validate([
            'origin' => 'required',
            'destination' => 'required',
            'weight' => 'required|numeric|min:1'
        ]);

        $items = [[
            'name' => 'Barang Farmasi',
            'value' => 50000,
            'weight' => (int) $request->weight,
            'quantity' => 1
        ]];

        $rates = $this->biteship->getRates($request->origin, $request->destination, $items);

        // Sekarang kita kembalikan JSON agar bisa dibaca oleh JavaScript (AJAX)
        return response()->json($rates);
    }
}