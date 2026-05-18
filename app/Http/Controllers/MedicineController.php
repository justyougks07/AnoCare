<?php

namespace App\Http\Controllers;

use App\Models\Medicine;
use Illuminate\Http\Request;

class MedicineController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    |  MANAJEMEN DATA OBAT & STOK APOTEK
    |--------------------------------------------------------------------------
    */

    /**
     * TAMPILAN UTAMA (INDEX)
     * Mengambil seluruh data dari tabel medicines untuk ditampilkan ke tabel.
     */
    public function index()
    {
        $medicines = Medicine::all();
        return view('medicines.index', compact('medicines'));
    }

    /**
     * FORM TAMBAH OBAT (CREATE)
     * Mengarahkan user ke halaman input data obat baru.
     */
    public function create()
    {
        return view('medicines.create');
    }

    /**
     * PROSES SIMPAN (STORE)
     * Memvalidasi inputan dan menyimpan data obat baru ke database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'  => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|numeric|min:0',
        ]);

        Medicine::create($request->all());

        return redirect()->route('medicines.index')
                         ->with('success', 'Obat baru berhasil ditambahkan ke sistem!');
    }

    /**
     * HALAMAN RESEP (PRESCRIPTION)
     * Mengambil daftar obat agar dokter/apoteker bisa memilih obat untuk resep.
     */
    public function prescription()
    {
        $medicines = Medicine::all();
        return view('medicines.prescription', compact('medicines'));
    }

    /**
     * PROSES POTONG STOK (REDUCE STOCK)
     * Mengurangi jumlah stok obat secara otomatis berdasarkan jumlah di resep.
     */
    public function reduceStock(Request $request)
    {
        $request->validate([
            'medicine_id' => 'required|exists:medicines,id',
            'quantity'    => 'required|numeric|min:1',
        ]);

        $medicine = Medicine::findOrFail($request->medicine_id);
        
        // Proteksi jika stok yang diminta melebihi stok yang ada
        if ($medicine->stock < $request->quantity) {
            return redirect()->back()
                             ->with('error', "Stok {$medicine->name} tidak cukup (Tersisa: {$medicine->stock})");
        }

        // Mengurangi stok menggunakan method decrement
        $medicine->decrement('stock', $request->quantity);

        return redirect()->route('medicines.index')
                         ->with('success', 'Stok berhasil dipotong sesuai resep!');
    }

    /**
     * EDIT SATUAN (EDIT)
     * Mengambil satu data obat berdasarkan ID untuk diedit.
     */
    public function edit(string $id)
    {
        $medicine = Medicine::findOrFail($id);
        return view('medicines.edit', compact('medicine'));
    }

    /**
     * UPDATE SATUAN (UPDATE)
     * Memperbarui data satu obat di database.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name'  => 'required',
            'price' => 'required|numeric',
            'stock' => 'required|numeric',
        ]);

        $medicine = Medicine::findOrFail($id);
        $medicine->update($request->all());

        return redirect()->route('medicines.index')
                         ->with('success', 'Data obat berhasil diperbarui!');
    }

    /**
     * EDIT STOK MASSAL (EDIT ALL STOCK)
     * Menampilkan semua obat dalam form input untuk update stok sekaligus.
     */
    public function editAllStock()
    {
        $medicines = Medicine::all();
        return view('medicines.edit_all_stock', compact('medicines'));
    }

    /**
     * UPDATE STOK MASSAL (UPDATE ALL STOCK)
     * Memproses banyak data stok sekaligus menggunakan perulangan (foreach).
     */
    public function updateAllStock(Request $request)
    {
        // $request->stocks berisi array [id_obat => jumlah_stok]
        foreach ($request->stocks as $id => $newStock) {
            Medicine::where('id', $id)->update(['stock' => $newStock]);
        }

        return redirect()->route('medicines.index')
                         ->with('success', 'Seluruh stok obat berhasil disinkronisasi!');
    }

    /**
     * HAPUS DATA (DESTROY)
     * Menghapus data obat dari sistem secara permanen.
     */
    public function destroy(string $id)
    {
        $medicine = Medicine::findOrFail($id);
        $medicine->delete();
        
        return redirect()->route('medicines.index')
                         ->with('success', 'Data obat telah dihapus!');
    }

    // Method Show tidak digunakan dalam manajemen stok sederhana
    public function show(string $id) { /* N/A */ }
}