@extends('welcome')
@section('content')
<div class="container mt-5">
  <div class="card p-4">
    <form action="{{route('edit.produk',$produk->id)}}" method="post" enctype="multipart/form-data">
    @csrf  
    @method('put')
      <div class="row">
        <div class="col">
          <label for="name">Nama</label>
          <input name="name" type="text" class="form-control" placeholder="name" value="{{$produk->name}}">
        </div>
        <div class="col">
          <label for="description">Deskripsi</label>
          <input name="deskripsi" type="text" class="form-control" placeholder="description" value="{{$produk->description}}">
        </div>
      </div>
      <label for="Categori">Kategori</label>
      <select id="Categori" name="categori_id" class="form-control">
        <option value="{{$produk->categori_id}}">{{$produk->categori->name}}</option>
        @foreach($categories as $kategori)
        <option value="{{$kategori->id}}">{{$kategori->name}}</option>
        @endforeach
      </select>
      <button type="submit" class="btn btn-primary mt-3">Simpan</button>
    </form>
  </div>
</div>
@endsection