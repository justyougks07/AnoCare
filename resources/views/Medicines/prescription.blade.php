<h1>Berikan Resep Obat</h1>

<form action="{{ route('prescriptions.store') }}" method="POST">
    @csrf
    <div>
        <label>Pilih Obat:</label><br>
        <select name="medicine_id" required>
            <option value="">-- Pilih Obat --</option>
            @foreach($medicines as $medicine)
                <option value="{{ $medicine->id }}">
                    {{ $medicine->name }} (Sisa Stok: {{ $medicine->stock }})
                </option>
            @endforeach
        </select>
    </div><br>

    <div>
        <label>Jumlah yang Diberikan:</label><br>
        <input type="number" name="quantity" min="1" required>
    </div><br>

    <button type="submit" style="background: blue; color: white; padding: 10px;">Proses Resep</button>
    <a href="{{ route('medicines.index') }}">Kembali</a>
</form>