<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Manajemen Barang</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-6">
  <div class="max-w-6xl mx-auto bg-white p-6 rounded shadow">
    <!-- Header -->
    <div class="flex justify-between items-center mb-4">
      <h1 class="text-2xl font-bold">Manajemen Barang</h1>
      <a href="{{ route('produk.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">+ Tambah Barang</a>
    </div>

    <!-- Tabel Daftar Barang -->
    <div>
      <h2 class="text-xl font-semibold mb-2">Daftar Barang</h2>
      <div class="overflow-x-auto">
        <table class="w-full text-left border">
          <thead class="bg-gray-200">
            <tr>
              <th class="p-2">NAMA</th>
              <th class="p-2">HARGA</th>
              <th class="p-2">DESKRIPSI</th>
              <th class="p-2">KATEGORI</th>
              <th class="p-2">AKSI</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($produk as $item)
              <tr class="border-t">
                <td class="p-2">{{ $item->nama }}</td>
                <td class="p-2">Rp {{ number_format($item->harga, 0, ',', '.') }}</td>
                <td class="p-2">{{ $item->deskripsi }}</td>
                <td class="p-2">{{ $item->kategori }}</td>
                <td class="p-2 space-x-2">
                  <a href="{{ route('produk.edit', $item->id) }}" class="bg-yellow-400 px-3 py-1 rounded text-white hover:bg-yellow-500">Edit</a>
                  <form action="{{ route('produk.destroy', $item->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-600 px-3 py-1 rounded text-white hover:bg-red-700">Hapus</button>
                  </form>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</body>
</html>
