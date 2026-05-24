<?php

namespace App\Services;

use App\Models\Produk;

class ProdukService
{
    public function getAll()
    {
        return Produk::all();
    }

    public function getById(int $id)
    {
        return Produk::findOrFail($id);
    }

    public function create(array $data): Produk
    {
        return Produk::create($data);
    }

    public function update(int $id, array $data): Produk
    {
        $produk = Produk::findOrFail($id);
        $produk->update($data);
        return $produk;
    }

    public function delete(int $id): void
    {
        $produk = Produk::findOrFail($id);
        $produk->delete();
    }
}