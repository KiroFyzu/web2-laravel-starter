<?php

namespace App\Services;

use App\Models\Coffee;
use Illuminate\Database\QueryException;
use RuntimeException;

class CoffeeService
{
    /**
     * Simpan data coffee baru dari input yang sudah tervalidasi.
     *
     * @param  array<string, mixed>  $validatedData
     */
    public function createCoffee(array $validatedData): Coffee
    {
        try {
            return Coffee::create($validatedData);
        } catch (QueryException $exception) {
            throw new RuntimeException('Gagal menyimpan data menu kopi. Silakan coba lagi.', 0, $exception);
        }
    }
}
