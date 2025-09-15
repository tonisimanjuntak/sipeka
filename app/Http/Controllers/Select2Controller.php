<?php

namespace App\Http\Controllers\admin;

use App\Models\Kategori;
use App\Models\Formasiasn;
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

    public function kategori(Request $request)
    {
        $search = $request->input('q');

        $results = Kategori::where('namakategori', 'LIKE', "%{$search}%")
            ->where('statusaktif', 'Aktif')
            ->limit(50)
            ->get();

        $formattedResults = $results->map(function ($item) {
            return [
                'id' => $item->idkategori,
                'text' => $item->namakategori,
            ];
        });

        return response()->json(['results' => $formattedResults]);
    }

    
    public function formasiasn(Request $request)
    {
        $search = $request->input('q');
        $idjenistryout = $request->input('idjenistryout');

        $query = Formasiasn::where('namaformasiasn', 'LIKE', "%{$search}%")
            ->where('statusaktif', 'Aktif');

        switch ($idjenistryout) {
            case '002': //Guru
                $query->where('jenis', 'Guru');
                break;
            case '003': //Kesehatan
                $query->where('jenis', 'Kesehatan');
                break;
            case '004': //teknis
                $query->where('jenis', 'Teknis');
                break;            
            default:
                // Tidak ada filter tambahan jika idjenistryout tidak sesuai
                break;
        }
        $results = $query->limit(50)->get();

        $formattedResults = $results->map(function ($item) {
            return [
                'id' => $item->idformasiasn,
                'text' => $item->namaformasiasn,
            ];
        });

        return response()->json(['results' => $formattedResults]);
    }
}
