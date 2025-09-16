<?php

namespace App\Http\Controllers;

use App\Models\Pengaturan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class PengaturanController extends Controller
{
    var $pengaturan;

    public function __construct()
    {
        $this->pengaturan = new Pengaturan;
    }

    public function index()
    {
        $pengaturan = Pengaturan::all();
        $data['pengaturan'] = $pengaturan;
        $data['menu'] = 'pengaturan';
        return view('admin.pengaturan.index', $data);
    }

    public function tambah()
    {
        $data['menu'] = 'pengaturan';
        $data['prefix'] = "";
        $data['ltambah'] = "1";
        return view('admin.pengaturan.form', $data);
    }

    public function edit($prefix)
    {
        try {
            $prefix = Crypt::decrypt($prefix);
            $rsKategori = Pengaturan::findOrFail($prefix);
        } catch (ModelNotFoundException $e) {
            return redirect('admin/pengaturan')->with('other', 'Data tidak ditemukan!');
        }
        $data['menu'] = 'pengaturan';
        $data['prefix'] = $prefix;
        $data['ltambah'] = "0";
        return view('admin.pengaturan.form', $data);
    }

    public function listindex(Request $request)
    {
        // Query dasar
        $query = Pengaturan::select(['prefix', 'values', 'deskripsi']);

        // Cek apakah ada pencarian
        if ($request->has('search') && !empty($request->input('search.value'))) {
            $search = $request->input('search.value');
            $query->where('prefix', 'LIKE', "%{$search}%")
                ->orWhere('values', 'LIKE', "%{$search}%");
        }

        // Sorting berdasarkan kolom yang diklik
        if ($request->has('order')) {
            $orderColumn = $request->input('order.0.column'); // Index kolom yang di-sort
            $orderDirection = $request->input('order.0.dir'); // Arah sorting (asc/desc)

            // Daftar kolom yang bisa di-sort
            $columns = [null, 'prefix', 'values', null, null];

            // Pastikan index kolom valid
            if (isset($columns[$orderColumn])) {
                $query->orderBy($columns[$orderColumn], $orderDirection);
            } else {
                $query->orderBy('prefix', 'Asc');
            }
        } else {
            $query->orderBy('prefix', 'Asc');
        }


        // Hitung total data tanpa filter
        $totalData = Pengaturan::count();

        // Hitung total data setelah filter (jika ada pencarian)
        $totalFiltered = $query->count();

        // Ambil parameter 'length' dan 'start' dari DataTables
        $limit = $request->input('length', 10);
        $start = $request->input('start', 0);

        // Ambil data dengan limit dan offset
        $rsData = $query->offset($start)
            ->limit($limit)
            ->get();

        // Format data untuk DataTables
        $data = [];
        $no = 1;
        foreach ($rsData as $row) {

            $data[] = [
                'no' => $no++,
                'prefix' => $row->prefix,
                'values' => $row->values,
                'deskripsi' => $row->deskripsi,
                'action' => '<a href="' . url('admin/pengaturan/edit/' . Crypt::encrypt($row->prefix)) . '" class="btn btn-warning"><i class="fa fa-edit mr-1"></i>Edit</a>',

            ];
        }

        // Response untuk DataTables
        return response()->json([
            'draw' => intval($request->input('draw')),
            'recordsTotal' => $totalData,
            'recordsFiltered' => $totalFiltered,
            'data' => $data,
        ]);
    }

    public function simpan(Request $request)
    {
        $ltambah = $request->get('ltambah');
        $prefix = $request->get('prefix');
        $values = $request->get('values');
        $deskripsi = $request->get('deskripsi');
        $inserted_date = date('Y-m-d H:i:s');
        $updated_date = date('Y-m-d H:i:s');

        if ($ltambah == '1') {

            $data = array(
                'prefix' => $prefix,
                'values' => $values,
                'inserted_date' => $inserted_date,
                'updated_date' => $updated_date,
                'deskripsi' => $deskripsi,
            );

            $simpan = $this->pengaturan->simpanData($data);
        } else {
            $data = array(
                'prefix' => $prefix,
                'values' => $values,
                'updated_date' => $updated_date,
                'deskripsi' => $deskripsi,
            );
            $simpan = $this->pengaturan->updateData($data, $prefix);
        }

        // dd(htmlspecialchars($simpan['message']));
        if ($simpan['status'] == 'success') {
            return redirect('admin/pengaturan')->with('success', $simpan['message']);
        } else {
            return redirect('admin/pengaturan')->with('fail', 'Data gagal disimpan! Error: ' . $simpan['message']);
        }
    }



    public function hapus($prefix)
    {
        $prefix = Crypt::decrypt($prefix);
        try {
            $rsKategori = Pengaturan::findOrFail($prefix);
        } catch (ModelNotFoundException $e) {
            return redirect('admin/pengaturan')->with('other', 'Data tidak ditemukan!');
        }

        $hapus = $this->pengaturan->hapusData($prefix, $rsKategori);
        if ($hapus['status'] == 'success') {
            return redirect('admin/pengaturan')->with('success', $hapus['message']);
        } else {
            return redirect('admin/pengaturan')->with('fail', 'Data gagal dihapus! Error: ' . $hapus['message']);
        }
    }

    public function getId(Request $request)
    {
        $prefix = $request->input('prefix');
        $rsKategori = Pengaturan::find($prefix);
        return response()->json($rsKategori);
    }
}
