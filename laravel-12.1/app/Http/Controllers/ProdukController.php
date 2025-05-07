<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    public function store(Request $request){
        $path = null; // Initialize with a default value
        if ($request->hasFile('Foto')) {
            $path = $request->file('Foto')->store('produk', 'public'); // Simpan ke storage/app/public/produk
            $path = 'storage/' . $path;
        }

        Produk::create([
            'first_name'=>$request->FirstName,
            'last_name'=>$request->LastName,
            'gambar'=>$path
        ]);
        return redirect()->route('dashboard')->with('success', 'Produk berhasil ditambahkan!');
    }

    public function update(Request $request,$id){
        $produk = Produk::findOrFail($id); // Find the product by ID or fail

        if (!$request->hasFile('Foto')) {
            $path = $produk->gambar; // Use the existing image path if no new file is uploaded
        } else {
            $path = $request->file('Foto')->store('produk', 'public'); // Simpan ke storage/app/public/produk
            $path = 'storage/' . $path; // Update the path to include 'storage/'
        }

        $produk->update([
            'first_name' => $request->FirstName,
            'last_name' => $request->LastName,
            'gambar' => $path
        ]);
        return redirect()->route('dashboard')->with('success', 'Produk berhasil diperbarui!');
    }

    public function destroy($id){
        $produk = Produk::findOrFail($id); // Find the product by ID or fail
        $produk->delete();
        return redirect()->route('dashboard')->with('success', 'Produk berhasil dihapus!');
    }
}
