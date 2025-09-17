<?php

namespace App\Http\Controllers;

use App\Models\Kabupaten;
use App\Models\Kecamatan;
use App\Models\Kelurahan;
use App\Models\App;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class Select2Controller extends Controller
{
    var $App;

    public function __construct()
    {
        $this->App = new App;
    }

    public function searchKabupaten(Request $request)
    {
        $search = $request->input('q'); // Ambil parameter pencarian

        // Query pencarian
        $results = Kabupaten::where('namakabupaten', 'LIKE', "%{$search}%")
            ->orWhere('kodekabupaten', 'LIKE', "%{$search}%")
            ->limit(50)
            ->get();

        // Format data untuk Select2
        $formattedResults = $results->map(function ($item) {
            return [
                'id' => $item->kodekabupaten,
                'text' => $item->kodekabupaten . ' - ' . $item->namakabupaten,
            ];
        });

        return response()->json(['results' => $formattedResults]);
    }

    public function searchKecamatan(Request $request)
    {
        $search = $request->input('q'); // Ambil parameter pencarian
        $kodekabupaten = $request->input('kodekabupaten');

        // Query pencarian
        $results = Kecamatan::where('kodekabupaten', $kodekabupaten)
            ->where('namakecamatan', 'LIKE', "%{$search}%")
            ->limit(50)
            ->get();

        // Format data untuk Select2
        $formattedResults = $results->map(function ($item) {
            return [
                'id' => $item->kodekecamatan,
                'text' => $item->kodekecamatan . ' - ' . $item->namakecamatan,
            ];
        });

        return response()->json(['results' => $formattedResults]);
    }

    public function searchKelurahan(Request $request)
    {
        $search = $request->input('q'); // Ambil parameter pencarian

        // Query pencarian
        $results = Kelurahan::where('namakelurahan', 'LIKE', "%{$search}%")
            ->orWhere('kodekelurahan', 'LIKE', "%{$search}%")
            ->limit(50)
            ->get();

        // Format data untuk Select2
        $formattedResults = $results->map(function ($item) {
            return [
                'id' => $item->kodekelurahan,
                'text' => $item->kodekelurahan . ' - ' . $item->namakelurahan,
            ];
        });

        return response()->json(['results' => $formattedResults]);
    }

}
