<?php

namespace App\Imports;

use App\Models\Banksoalimport;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class SoalImport implements ToModel, WithStartRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */

    public function startRow(): int
    {
        return 2; // Mulai dari baris ke-2, abaikan baris pertama (header)
    }

    public function model(array $row)
    {
        if (empty($row[1])) {
            return null;
        }

        return new Banksoalimport([
            'pertanyaan'   => $row[1],
            'pilihan_a'    => $row[2],
            'pilihan_b'    => $row[3],
            'pilihan_c'    => $row[4],
            'pilihan_d'    => $row[5],
            'pilihan_e'    => $row[6],
            'jawaban'      => $row[7],
            'penjelasan'   => $row[8],
        ]);
    }
}
