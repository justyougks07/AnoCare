<h1>Daftar Stok Obat Klinik</h1>

<table border="1" cellpadding="10" cellspacing="0" style="width: 100%; border-collapse: collapse;">
    <thead>
        <tr style="background-color: #f2f2f2;">
            <th>Nama Obat</th>
            <th>Jenis</th>
            <th>Harga</th>
            <th>Stok</th>
            <th>Status</th>
        </tr>
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
        </tr>
        @endforeach
        <a href="{{ route('medicines.create') }}" style="display: inline-block; background: blue; color: white; padding: 10px; text-decoration: none; border-radius: 5px; margin-bottom: 10px;">
         + Tambah Obat Baru</a>

        <th>Aksi</th>
...
        <td>
         <a href="{{ route('medicines.edit', $medicine->id) }}" style="color: blue;">Edit/Stok</a>
        </td>
        <a href="{{ route('prescriptions.create') }}" style="background: green; color: white; padding: 10px; text-decoration: none; border-radius: 5px;">
    + Berikan Resep (Pilih Obat)</a>
    <a href="{{ route('medicines.editAllStock') }}" style="background: orange; color: white; padding: 10px; text-decoration: none; border-radius: 5px;">
    ⚙️ Update Stok Massal
     </a>
    </tbody>
</table>