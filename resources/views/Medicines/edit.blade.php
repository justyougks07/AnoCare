<h1>Edit / Tambah Stok Obat: {{ $medicine->name }}</h1>

<form action="{{ route('medicines.update', $medicine->id) }}" method="POST">
    @csrf
    @method('PUT')
    
    <div>
        <label>Nama Obat:</label><br>
        <input type="text" name="name" value="{{ $medicine->name }}" required>
    </div><br>

    <div>
        <label>Harga (Rp):</label><br>
        <input type="number" name="price" value="{{ $medicine->price }}" required>
    </div><br>
    
    <div>
        <label>Stok Saat Ini (Ubah untuk menambah/mengurangi):</label><br>
        <input type="number" name="stock" value="{{ $medicine->stock }}" required>
    </div><br>

    <button type="submit" style="background: blue; color: white; padding: 10px;">Simpan Perubahan</button>
    <a href="{{ route('medicines.index') }}">Batal</a>
</form>