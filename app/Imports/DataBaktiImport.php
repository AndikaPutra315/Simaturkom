<?php

namespace App\Imports;

use App\Models\DataBakti;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\SkipsFailures;

class DataBaktiImport implements ToModel, WithStartRow, WithValidation, SkipsOnFailure
{
    use SkipsFailures;

    /**
     * Fungsi ini berjalan SEBELUM Validasi.
     * 1. Mengubah string kosong "" menjadi NULL.
     * 2. Mengubah format DMS (1°45'37.61"S) menjadi Desimal (-1.760447).
     */
    public function prepareForValidation($data, $index)
    {
        // 1. Handle Kode Kosong (seperti sebelumnya)
        if (empty($data['0']) || trim($data['0']) === '') {
            $data['0'] = null;
        }

        // 2. Handle Konversi Longitude (Kolom 5)
        if (!empty($data['5'])) {
            $data['5'] = $this->convertDMSToDecimal($data['5']);
        }

        // 3. Handle Konversi Latitude (Kolom 6)
        if (!empty($data['6'])) {
            $data['6'] = $this->convertDMSToDecimal($data['6']);
        }

        // 4. Handle Tinggi Tower (Kolom 8)
        // Bersihkan jika ada teks " meter" atau "m"
        if (!empty($data['8'])) {
             $data['8'] = (int) filter_var($data['8'], FILTER_SANITIZE_NUMBER_INT);
        }

        return $data;
    }

    /**
     * Helper Function: Rumus Matematika Konversi DMS ke Desimal
     */
    private function convertDMSToDecimal($coordinate)
    {
        // Jika sudah angka biasa (desimal), kembalikan langsung
        if (is_numeric($coordinate)) {
            return (float) $coordinate;
        }

        $coordinate = trim($coordinate);

        // Regex untuk menangkap format: 1°45'37.61"S
        // Grup 1: Derajat, Grup 2: Menit, Grup 3: Detik, Grup 4: Arah (S/N/E/W)
        if (preg_match('/(\d+)°(\d+)\'([\d.]+)"([NSEW])/i', $coordinate, $matches)) {
            $degrees = (float) $matches[1];
            $minutes = (float) $matches[2];
            $seconds = (float) $matches[3];
            $direction = strtoupper($matches[4]);

            // Rumus: Derajat + (Menit/60) + (Detik/3600)
            $decimal = $degrees + ($minutes / 60) + ($seconds / 3600);

            // Jika Arah Selatan (S) atau Barat (W), jadikan negatif
            if ($direction == 'S' || $direction == 'W') {
                $decimal = $decimal * -1;
            }

            return $decimal;
        }

        // Jika format tidak dikenali, kembalikan null (nanti akan ditolak validasi)
        return null;
    }

    /**
     * @param array $row
     */
    public function model(array $row)
    {
        if (!array_filter($row)) {
            return null;
        }

        return new DataBakti([
            'kode'          => (empty($row[0]) || trim($row[0]) === '') ? null : $row[0],
            'provider'      => $row[1],
            'kelurahan'     => $row[2],
            'kecamatan'     => $row[3],
            'alamat'        => $row[4] ?? null,
            'longitude'     => isset($row[5]) ? (float) $row[5] : null,
            'latitude'      => isset($row[6]) ? (float) $row[6] : null,
            'status'        => $row[7] ?? null,
            'tinggi_tower'  => isset($row[8]) ? (int) $row[8] : null,
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
            // Tetap gunakan 'numeric' karena data sudah dikonversi jadi angka di prepareForValidation
            '5' => ['nullable', 'numeric'],
            '6' => ['nullable', 'numeric'],
            '8' => ['nullable', 'integer'],
        ];
    }

    public function customValidationAttributes()
    {
        return [
            '0' => 'Kode',
            '1' => 'Provider (Nama)',
            '2' => 'Kelurahan',
            '3' => 'Kecamatan',
            '5' => 'Longitude',
            '6' => 'Latitude',
            '8' => 'Tinggi Tower',
        ];
    }
}
