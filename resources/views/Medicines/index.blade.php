<h1>Daftar Stok Obat Klinik</h1>

<div style="margin-bottom: 20px;">
    <a href="{{ route('medicines.create') }}" style="display: inline-block; background: blue; color: white; padding: 10px; text-decoration: none; border-radius: 5px;">
        + Tambah Obat Baru
    </a>

    <a href="{{ route('prescriptions.create') }}" style="display: inline-block; background: green; color: white; padding: 10px; text-decoration: none; border-radius: 5px; margin-left: 10px;">
        + Berikan Resep (Pilih Obat)
    </a>

    <a href="{{ route('medicines.editAllStock') }}" style="display: inline-block; background: orange; color: white; padding: 10px; text-decoration: none; border-radius: 5px; margin-left: 10px;">
        ⚙️ Update Stok Massal
    </a>
</div>

<table border="1" cellpadding="10" cellspacing="0" style="width: 100%; border-collapse: collapse;">
    <thead>
        <tr style="background-color: #f2f2f2;">
            <th>Nama Obat</th>
            <th>Jenis</th>
            <th>Harga</th>
            <th>Stok</th>
            <th>Status</th>
            <th>Aksi</th> </tr>
    </thead>
    <tbody>
        @foreach($medicines as $medicine)
        <tr>
            <td>{{ $medicine->name }}</td>
            <td>{{ $medicine->type }}</td>
            <td>Rp {{ number_format($medicine->price, 0, ',', '.') }}</td>
            <td>{{ $medicine->stock }}</td>
            <td>
                @if($medicine->stock <= $medicine->min_stock)
                    <span style="background-color: #ffcccc; color: #cc0000; padding: 5px; border-radius: 5px; font-weight: bold;">
                        ⚠️ Stok Menipis!
                    </span>
                @else
                    <span style="color: green; font-weight: bold;">✅ Aman</span>
                @endif
            </td>
            <td>
                <a href="{{ route('medicines.edit', $medicine->id) }}" style="color: blue; font-weight: bold; text-decoration: none;">
                    Edit/Stok
                </a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>