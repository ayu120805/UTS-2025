<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    // Menampilkan daftar produk dengan pencarian, filter, dan pagination
    public function index(Request $request)
    {
        // Ambil daftar kategori unik
        $kategoriList = Produk::select('kategori')->distinct()->pluck('kategori');

        // Query awal
        $query = Produk::query();

        // Filter berdasarkan pencarian nama
        if ($request->has('search') && $request->search != '') {
            $query->where('nama', 'like', '%' . $request->search . '%');
        }

        // Filter berdasarkan kategori
        if ($request->has('kategori') && $request->kategori != '') {
            $query->where('kategori', $request->kategori);
        }

        // Pagination (10 item per halaman) + withQueryString agar filter tetap saat pindah halaman
        $produk = $query->paginate(10)->withQueryString();

        return view('produk.index', compact('produk', 'kategoriList'));
    }

    // Menampilkan form untuk membuat produk baru
    public function create()
    {
        return view('produk.create');
    }

    // Menyimpan produk baru ke dalam database
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'harga' => 'required|numeric',
            'deskripsi' => 'nullable',
            'kategori' => 'nullable',
        ]);

        Produk::create($request->all());

        return redirect()->route('produk.index')->with('success', 'Produk berhasil ditambahkan');
    }

    // Menampilkan form untuk mengedit produk
    public function edit($id)
    {
        $produk = Produk::findOrFail($id);
        return view('produk.edit', compact('produk'));
    }

    // Memperbarui produk yang telah diedit
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'nama' => 'required|max:255',
            'deskripsi' => 'required',
            'harga' => 'required|numeric',
            'kategori' => 'required|max:255',
        ]);

        $produk = Produk::findOrFail($id);
        $produk->update($validatedData);

        return redirect()->route('produk.index');
    }

    // Menghapus produk dari database
    public function destroy($id)
    {
        $produk = Produk::findOrFail($id);
        $produk->delete();

        return redirect()->route('produk.index');
    }

    // Menampilkan detail produk
    public function show($id)
    {
        $produk = Produk::findOrFail($id);
        return view('produk.show', compact('produk'));
    }
}
