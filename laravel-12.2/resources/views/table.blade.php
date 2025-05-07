@extends('welcome')
@section('content')
<div class="container mt-5">
    <a href="{{route('add')}}" type="button" class="btn btn-primary mb-4">Tambah</a>
        <div class="card">
            <table class="table">
                <thead>
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Deskripsi</th>
                    <th scope="col">Kategori</th>
                    <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($produk as $item)
                    <tr>
                        <th scope="row">{{$loop->iteration}}</th>
                        <td>{{$item->name}}</td>
                        <td>{{$item->description}}</td>
                        <td>{{$item->categori->name}}</td>
                        <td>
                            <form action="{{route('edit', $item->id)}}" method="post" enctype="multipart/form-data">
                            @csrf    
                            <button type="submit" class="btn btn-primary">Update</button>
                            </form>
                            <form action="{{route('delete.produk',$item->id)}}" method="post" onclick="return confirm('Are you sure you want to delete this item?')">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-danger" >Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
</div>
@endsection