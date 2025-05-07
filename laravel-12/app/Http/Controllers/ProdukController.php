<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //jika ada serach
        if ($request->has('search')) {
            $produks = Produk::where('nama_produk', 'like', '%' . $request->search . '%')->orderBy('created_at', 'desc')->paginate(4);
        } else {
            $produks = Produk::orderBy('created_at', 'desc')->paginate(4);
        }
        return view('form', compact('produks'));
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $path = null; // Initialize with a default value

        if ($request->hasFile('gambar')) {
            $path = $request->file('gambar')->store('produk', 'public'); // Simpan ke storage/app/public/produk
            $path = 'storage/' . $path;
        }
    
        Produk::create([
            'nama_produk' => $request->nama_produk,
            'harga_produk' => $request->harga_produk,
            'gambar_produk' => $path // This will be null if no file is uploaded
        ]);
    
        return redirect()->route('produk.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Produk $produk)
    {
        if (!$request->hasFile('gambar')) {
            $path = $produk->gambar_produk; // Use the existing image path if no new file is uploaded
        } else {
            $path = $request->file('gambar')->store('produk', 'public'); // Simpan ke storage/app/public/produk
            $path = 'storage/' . $path; // Update the path to include 'storage/'
        }
        $produk->update([
            'nama_produk' => $request->nama_produk,
            'harga_produk' => $request->harga_produk,
            'gambar_produk' => $path
        ]);
    
        return redirect()->route('produk.index')->with(['success' => 'Data Berhasil Diupdate!']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Produk $produk)
    {
        $produk->delete();
        return redirect()->route('produk.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}
