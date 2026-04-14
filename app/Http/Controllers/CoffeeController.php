<?php

namespace App\Http\Controllers;

use App\Models\Coffee;
use App\Services\CoffeeService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class CoffeeController extends Controller
{
    public function __construct(private CoffeeService $coffeeService)
    {
    }

    /**
     * Tampilkan daftar menu kopi.
     */
    public function index(): View
    {
        $coffees = Coffee::latest()->get();

        return view('coffees.index', compact('coffees'));
    }

    /**
     * Tampilkan form tambah menu kopi.
     */
    public function create(): View
    {
        return view('coffees.create');
    }

    /**
     * Tambah data menu kopi.
     * Wajib berisi: validasi request, error handling, dan pemanggilan service.
     */
    public function store(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:120', 'unique:coffees,name'],
            'description' => ['nullable', 'string'],
            'price' => ['required', 'numeric', 'min:0.01'],
            'stock' => ['required', 'integer', 'min:0'],
        ]);

        try {
            $this->coffeeService->createCoffee($validatedData);

            return redirect()
                ->route('coffees.index')
                ->with('success', 'Menu kopi berhasil ditambahkan.');
        } catch (\Throwable $exception) {
            Log::error('Gagal menambahkan menu kopi', [
                'message' => $exception->getMessage(),
                'trace' => $exception->getTraceAsString(),
            ]);

            return back()
                ->withInput()
                ->withErrors(['store_error' => 'Terjadi kesalahan saat menyimpan data.']);
        }
    }

    /**
     * Tampilkan form ubah data menu kopi.
     */
    public function edit(Coffee $coffee): View
    {
        return view('coffees.edit', compact('coffee'));
    }

    /**
     * Ubah data menu kopi.
     */
    public function update(Request $request, Coffee $coffee): RedirectResponse
    {
        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:120', 'unique:coffees,name,' . $coffee->id],
            'description' => ['nullable', 'string'],
            'price' => ['required', 'numeric', 'min:0.01'],
            'stock' => ['required', 'integer', 'min:0'],
        ]);

        $coffee->update($validatedData);

        return redirect()
            ->route('coffees.index')
            ->with('success', 'Menu kopi berhasil diubah.');
    }

    /**
     * Hapus data menu kopi.
     */
    public function destroy(Coffee $coffee): RedirectResponse
    {
        $coffee->delete();

        return redirect()
            ->route('coffees.index')
            ->with('success', 'Menu kopi berhasil dihapus.');
    }
}
