<?php

namespace App\Imports;

use App\Models\DataMenara;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class DataMenaraImport implements ToModel, WithStartRow
{
    /**
     * @return int
     */
    public function startRow(): int
    {
        return 2; // Mulai membaca data dari baris ke-2 (karena baris 1 adalah header)
    }

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        // Pastikan Anda memiliki 9 kolom di Excel Anda sesuai urutan ini
        return new DataMenara([
            'kode'         => $row[0],
            'provider'     => $row[1],
            'kelurahan'    => $row[2],
            'kecamatan'    => $row[3],
            'alamat'       => $row[4],
            'longitude'    => $row[5],
            'latitude'     => $row[6],
            'status'       => $row[7],
            'tinggi_tower' => $row[8],
        ]);
    }
}
