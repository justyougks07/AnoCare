<h1>Tambah Obat Baru</h1>
<form action="{{ route('medicines.store') }}" method="POST">
    @csrf
    <div>
        <label>Nama Obat:</label><br>
        <input type="text" name="name" required>
    </div><br>
    <div>
        <label>Jenis:</label><br>
        <select name="type">
            <option value="Tablet">Tablet</option>
            <option value="Sirup">Sirup</option>
            <option value="Kaplet">Kaplet</option>
        </select>
    </div><br>
    <div>
        <label>Stok Awal:</label><br>
        <input type="number" name="stock" value="0">
    </div><br>
    <div>
        <label>Harga:</label><br>
        <input type="number" name="price" required>
    </div><br>
    <button type="submit">Simpan Obat</button>
    <a href="{{ route('medicines.index') }}">Kembali</a>
</form>