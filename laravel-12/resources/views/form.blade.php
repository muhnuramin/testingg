@extends('index')
@section('title', 'Halaman Form')
@section('content')
<div class="card mb-3">
  <div class="card-body">
  @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
  @endif

  <form id="form-produk" action="{{ route('produk.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-6">
            <label for="NamaProduk" class="form-label">Nama Produk</label>
            <input name="nama_produk" type="text" class="form-control" id="NamaProduk" aria-describedby="NamaProduk" required>
        </div>
        <div class="col-6">
            <label for="Harga" class="form-label">Harga</label>
            <input name="harga_produk" type="number" class="form-control" id="Harga" aria-describedby="Harga" required>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
        <label for="Gambar" class="form-label">Gambar</label>
        <input name="gambar" type="file" class="form-control" id="Gambar" aria-describedby="Gambar">
        <img class="d-none" id="previewGambar" src="" alt="Gambar Produk" style="max-width: 150px; margin-top: 10px;">    
    </div>
    </div>
    <button id="btnsubmit" type="submit" class="btn btn-primary mt-3">Submit</button>
  </form>
  </div>
</div>
<div class="card">
    <div class="card-body row d-flex justify-content-between">
      <form class="row">
        <div class="col-auto">
          <label for="search" class="visually-hidden">Search</label>
          <input name="search" type="search" class="form-control" id="search" placeholder="cari">
        </div>
        <div class="col-auto">
          <button type="submit" class="btn btn-primary mb-3">Cari</button>
        </div>
      </form>
  @forelse ($produks as $produk)
    <div class="card" style="width: 18rem;">
    <img src="{{asset($produk->gambar_produk)}}" class="card-img-top" alt="...">
    <div class="card-body">
        <h5 class="card-title">{{$produk->nama_produk}}</h5>
        <p class="card-text">Rp : {{$produk->harga_produk}}</p>
        <a onclick="getEdit('{{$produk}}')" class="btn btn-primary">Update</a>
        <form action="{{route('produk.destroy',$produk->id)}}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus produk ini?')">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Delete</button>
        </form>
    </div>
    </div>
    @empty
    <h1>Tidak ada produk.</h1>
    @endforelse
  </div>
  <div class="paginationDiv">
      {{$produks->links('pagination::bootstrap-5')}}
  </div>
</div>
@endsection
<script>
function getEdit(produk) {
  const parsedProduk = JSON.parse(produk);
  document.getElementById('NamaProduk').value = parsedProduk.nama_produk;
  document.getElementById('Harga').value = parsedProduk.harga_produk;
  document.getElementById('previewGambar').src = parsedProduk.gambar_produk;
  document.getElementById('btnsubmit').textContent='Update';
 
  if (parsedProduk.gambar_produk) {
      document.getElementById('previewGambar').classList.remove('d-none');
  }
  // Ganti action form ke update route
  const form = document.getElementById('form-produk');
  form.action = `/produk/${parsedProduk.id}`; // Pastikan route ini sesuai dengan route('produk.update', $id) di Laravel
    // Tambahkan input _method secara dinamis
  if (!document.getElementById('methodput')) {
    const methodInput = document.createElement('input');
    methodInput.type = 'hidden';
    methodInput.name = '_method';
    methodInput.value = 'PUT';
    methodInput.id = 'methodput';
    form.appendChild(methodInput);
  }
}
</script>