<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Http\Controllers\Controller;
use App\Models\Categories;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $produk = Produk::all();
        return view('table', compact('produk'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories=Categories::all();
        return view('add',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Produk::create([
            'name'=>$request->name,
            'description'=>$request->deskripsi,
            'categori_id'=>$request->category_id
        ]);
        return redirect()->route('index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Produk $produk)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $produk=Produk::findOrFail($id);
        $categories=Categories::all();
        return view('edit',compact('categories','produk'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $produk = Produk::findOrFail($id);
        $produk->update([
            'name'=>$request->name,
            'description'=>$request->deskripsi,
            'categori_id'=>$request->categori_id
        ]);

        return redirect()->route('index');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $produk = Produk::findOrFail($id);
        $produk->delete();
        return redirect()->route('index');
    }
}
