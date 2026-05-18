<?php

namespace App\Http\Controllers;

use App\Models\Medicine;
use Illuminate\Http\Request;

class MedicineController extends Controller
{
    /**
     * Tampilan Utama: Menampilkan semua daftar obat dan status stoknya.
     */
    public function index()
    {
        $medicines = Medicine::all();
        return view('medicines.index', compact('medicines'));
    }

    /**
     * Menampilkan form untuk menambah obat baru ke database.
     */
    public function create()
    {
        return view('medicines.create');
    }

    /**
     * Menyimpan data obat baru yang diinput dari form create.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'stock' => 'required|numeric',
        ]);

        Medicine::create($request->all());

        return redirect()->route('medicines.index')->with('success', 'Obat berhasil ditambahkan!');
    }

    /**
     * Menampilkan form resep (pilih obat dari dropdown untuk dikurangi stoknya).
     */
    public function prescription()
    {
        $medicines = Medicine::all();
        return view('medicines.prescription', compact('medicines'));
    }

    /**
     * Proses pengurangan stok berdasarkan input dari form resep.
     */
    public function reduceStock(Request $request)
    {
        $request->validate([
            'medicine_id' => 'required|exists:medicines,id',
            'quantity' => 'required|numeric|min:1',
        ]);

        $medicine = Medicine::findOrFail($request->medicine_id);
        
        if ($medicine->stock < $request->quantity) {
            return redirect()->back()->with('error', 'Stok obat ' . $medicine->name . ' tidak mencukupi!');
        }

        $medicine->decrement('stock', $request->quantity);

        return redirect()->route('medicines.index')->with('success', 'Resep berhasil dicatat, stok berkurang!');
    }

    /**
     * Menampilkan form edit untuk satu obat tertentu.
     */
    public function edit(string $id)
    {
        $medicine = Medicine::findOrFail($id);
        return view('medicines.edit', compact('medicine'));
    }

    /**
     * Mengupdate data obat (Nama, Harga, atau Stok) secara manual.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'stock' => 'required|numeric',
        ]);

        $medicine = Medicine::findOrFail($id);
        $medicine->update($request->all());

        return redirect()->route('medicines.index')->with('success', 'Data obat berhasil diperbarui!');
    }

    /**
     * Menampilkan halaman update stok massal untuk semua obat.
     */
    public function editAllStock()
    {
        $medicines = Medicine::all();
        // Pastikan file ini ada di resources/views/medicines/edit_all_stock.blade.php
        return view('medicines.edit_all_stock', compact('medicines'));
    }

    /**
     * Memproses update stok massal dari form edit_all_stock.
     */
    public function updateAllStock(Request $request)
    {
        // Melakukan perulangan untuk setiap input stok yang dikirim
        foreach ($request->stocks as $id => $newStock) {
            Medicine::where('id', $id)->update(['stock' => $newStock]);
        }

        return redirect()->route('medicines.index')->with('success', 'Semua stok berhasil diperbarui!');
    }

    public function destroy(string $id)
    {
        $medicine = Medicine::findOrFail($id);
        $medicine->delete();
        return redirect()->route('medicines.index')->with('success', 'Obat berhasil dihapus!');
    }

    public function show(string $id) { /* Kosong */ }
}