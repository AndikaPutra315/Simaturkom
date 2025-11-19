<?php

namespace App\Imports;

use App\Models\DataBakti;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\WithStartRow;

class DataBaktiImport implements ToModel, WithStartRow, WithValidation
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        if (empty(array_filter($row))) {
            return null;
        }

        return new DataBakti([
            'kode'          => $row[0] ?? null,  // Kolom 1 (Index 0)
            'provider'      => $row[1],          // Kolom 2 (Index 1)
            'kelurahan'     => $row[2],          // Kolom 3 (Index 2)
            'kecamatan'     => $row[3],          // Kolom 4 (Index 3)
            'alamat'        => $row[4] ?? null,  // Kolom 5 (Index 4)
            'longitude'     => $row[5] ?? null,  // Kolom 6 (Index 5)
            'latitude'      => $row[6] ?? null,  // Kolom 7 (Index 6)
            'status'        => $row[7] ?? null,  // Kolom 8 (Index 7)
            'tinggi_tower'  => $row[8] ?? null,  // Kolom 9 (Index 8)
        ]);
    }

    public function startRow(): int
    {
        return 2;
    }

    public function rules(): array
    {
        return [
            '1' => ['required', 'string', 'max:255'],
            '0' => ['nullable', 'string', 'max:255', 'unique:data_bakti,kode'],
            '5' => ['nullable', 'numeric'],
            '6' => ['nullable', 'numeric'],
            '8' => ['nullable', 'integer'],
        ];
    }
}
