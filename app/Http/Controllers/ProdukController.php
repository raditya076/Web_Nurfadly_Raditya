<?php

namespace App\Http\Controllers;

use App\Services\ProdukService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class ProdukController extends Controller
{
    protected ProdukService $produkService;

    public function __construct(ProdukService $produkService)
    {
        $this->produkService = $produkService;
    }

    // Fungsi Tampilkan Data
    public function index(): JsonResponse
    {
        $produks = $this->produkService->getAll();

        return response()->json([
            'success' => true,
            'data'    => $produks,
        ]);
    }

    // Fungsi Tambah Data (dengan validasi, error handling, service)
    public function store(Request $request): JsonResponse
    {
        // Request Validasi
        $validated = $request->validate([
            'nama'      => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'harga'     => 'required|numeric|min:0',
            'stok'      => 'required|integer|min:0',
        ]);

        // Error Handling
        try {
            $produk = $this->produkService->create($validated);

            return response()->json([
                'success' => true,
                'message' => 'Produk berhasil ditambahkan',
                'data'    => $produk,
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menambahkan produk: ' . $e->getMessage(),
            ], 500);
        }
    }

    // Fungsi Ubah Data
    public function update(Request $request, int $id): JsonResponse
    {
        $validated = $request->validate([
            'nama'      => 'sometimes|string|max:255',
            'deskripsi' => 'nullable|string',
            'harga'     => 'sometimes|numeric|min:0',
            'stok'      => 'sometimes|integer|min:0',
        ]);

        try {
            $produk = $this->produkService->update($id, $validated);

            return response()->json([
                'success' => true,
                'message' => 'Produk berhasil diubah',
                'data'    => $produk,
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengubah produk: ' . $e->getMessage(),
            ], 500);
        }
    }

    // Fungsi Hapus Data
    public function destroy(int $id): JsonResponse
    {
        try {
            $this->produkService->delete($id);

            return response()->json([
                'success' => true,
                'message' => 'Produk berhasil dihapus',
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus produk: ' . $e->getMessage(),
            ], 500);
        }
    }
}