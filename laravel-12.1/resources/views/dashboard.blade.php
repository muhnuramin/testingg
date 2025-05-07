<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#modalTambah">
                Tambah
                </button>
                <table class="table">
                    <thead>
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">First Name</th>
                        <th scope="col">Last Name</th>
                        <th scope="col">Foto</th>
                        <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($produk as $item)
                        <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{$item->first_name}}</td>
                        <td>{{$item->last_name}}</td>
                        <td>
                        <img  id="previewGambar" src="{{asset($item->gambar)}}" alt="Gambar Produk" style="max-width: 150px; margin-top: 10px;">
                        </td>
                        <td>
                        <button type="button" onclick="getEdit('{{$item}}')" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#modalEdit">
                            Edit
                        </button>
                        <form action="{{route('delete.produk',$item->id)}}" method="post" onsubmit="return confirm('Apakah Anda yakin ingin menghapus produk ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                        </td>
                        </tr>
                        @endforeach
                    </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
<!-- Modal add -->
<div class="modal fade" id="modalTambah" tabindex="-1" aria-labelledby="modalTambahLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
        <form action="{{route('add.produk')}}" method="POST" enctype="multipart/form-data">
        @csrf
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="modalTambahLabel">Modal Tambah</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
            <div class="row">
                <div class="col-auto mb-3">
                    <label for="FirstName" class="form-label">First Name</label>
                    <input type="text" class="form-control" id="FirstName" name="FirstName" required>
                </div>
                <div class="col-auto mb-3">
                    <label for="LastName" class="form-label">Last Name</label>
                    <input type="text" class="form-control" id="LastName" name="LastName" required>
                </div>
            </div>
            <div class="row">
                <div class="col-auto mb-3">
                    <label for="Foto" class="form-label">Foto</label>
                    <input type="file" class="form-control" id="Foto" name="Foto" accept=".jpg, .jpeg, .png">
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
        </form>
    </div>
  </div>
</div>
<!-- Modal edit -->
<div class="modal fade" id="modalEdit" tabindex="-1" aria-labelledby="modalEditLabel" aria-hidden="true">
  <div class="modal-dialog">
  <form id='form-produk' method="POST" enctype="multipart/form-data">
  @csrf
  @method('PUT')
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="modalEditLabel">Modal Edit</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <div class="row">
                <div class="col-auto mb-3">
                    <label for="FirstName" class="form-label">First Name</label>
                    <input type="text" class="form-control" id="FirstNameEdit" name="FirstName" required>
                </div>
                <div class="col-auto mb-3">
                    <label for="LastName" class="form-label">Last Name</label>
                    <input type="text" class="form-control" id="LastNameEdit" name="LastName" required>
                </div>
            </div>
            <div class="row">
                <div class="col-auto mb-3">
                    <label for="Foto" class="form-label">Foto</label>
                    <input type="file" class="form-control" id="FotoEdit" name="Foto" accept=".jpg, .jpeg, .png">
                </div>
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Update</button>
      </div>
      </form>
    </div>
  </div>
</div>
<script>
    function getEdit(produk) {
        const parsedProduk = JSON.parse(produk);
        console.log(produk);
        document.getElementById('FirstNameEdit').value = parsedProduk.first_name;
        document.getElementById('LastNameEdit').value = parsedProduk.last_name;
        // document.getElementById('previewGambarEdit').src = parsedProduk.gambar;

        const form = document.getElementById('form-produk');
        form.action = `/update-produk/${parsedProduk.id}`;
    }
</script>
