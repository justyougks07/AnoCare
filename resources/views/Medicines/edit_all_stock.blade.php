<h1>Update Stok Semua Obat</h1>

<form action="{{ route('medicines.updateAllStock') }}" method="POST">
    @csrf
    <table border="1" cellpadding="10" style="width: 100%; border-collapse: collapse;">
        <thead>
            <tr style="background-color: #eee;">
                <th>Nama Obat</th>
                <th>Stok Saat Ini</th>
                <th>Input Stok Baru</th>
            </tr>
        </thead>
        <tbody>
            @foreach($medicines as $medicine)
            <tr>
                <td>{{ $medicine->name }}</td>
                <td>{{ $medicine->stock }}</td>
                <td>
                    <input type="number" name="stocks[{{ $medicine->id }}]" value="{{ $medicine->stock }}" required>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <br>
    <button type="submit" style="background: blue; color: white; padding: 10px;">Update Semua Stok</button>
    <a href="{{ route('medicines.index') }}">Batal</a>
</form>