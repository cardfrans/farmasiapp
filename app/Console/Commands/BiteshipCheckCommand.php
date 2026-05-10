<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\BiteshipService;

class BiteshipCheckCommand extends Command
{
    // Ini adalah perintah yang akan diketik di terminal
    protected $signature = 'biteship:check {origin} {destination} {weight=1000}';

    protected $description = 'Cek ongkir Biteship langsung dari CLI';

    public function handle(BiteshipService $service)
    {
        $origin = $this->argument('origin');
        $destination = $this->argument('destination');
        $weight = $this->argument('weight');

        $this->info("Sedang mengecek ongkir dari $origin ke $destination...");

        $items = [[
            'name' => 'Barang Tes CLI',
            'value' => 100000,
            'weight' => (int) $weight,
            'quantity' => 1
        ]];


        $result = $service->getRates($origin, $destination, $items, 'jne,sicepat,jnt,anteraja,tiki,pos,lion,ninja,grab,gojek');

        if (isset($result['success']) && $result['success'] === false) {
            $this->error("Error: " . ($result['message'] ?? 'Terjadi kesalahan'));
            return;
        }

        // Tampilkan hasil dalam bentuk Tabel agar rapi di terminal
        $formattedPrice = collect($result['pricing'])->map(function ($item) {
            return [
                'Kurir' => $item['courier_name'] . " (" . $item['courier_service_code'] . ")",
                'Harga' => "Rp " . number_format($item['price'], 0, ',', '.'),
                'Estimasi' => $item['duration'],
            ];
        });

        $this->table(['Kurir', 'Harga', 'Estimasi'], $formattedPrice);
    }
}