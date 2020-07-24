@extends('layouts.app')

@section("head_title", "Daftar Mahasiswa")
@section("title")
<div class="container-fluid">
    <!-- Page-Title -->
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box" id="breadcrumb">
                <h4 class="page-title">Mahasiswa</h4>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active">
                        Menampilkan seluruh data mahasiswa
                    </li>
                </ol>

            </div>
        </div>
    </div>
</div>
@endsection
@section('content')
<div class="container-fluid" id="result">
    <div class="row">
        <div class="col-12">
            <div class="card m-b-20">
                <div class="card-body">

                    <h4 class="mt-0 header-title">Mahasiswa</h4>
                    <p class="text-muted m-b-30 font-14">Berikut adalah data seluruh Mahasiswa</p>
                    @if(session('success'))
                    <div class="alert alert-success">
                        {{session('success')}}
                    </div>
                    @endif
                    <div class="card-actions ">
                        <a class='btn btn-primary float-left' href="{{ route('mahasiswa.create') }}"><i class='ti ti-plus'></i> Tambah Mahasiswa</a>
                        <form action="" method="get" class='form-inline float-right mb-3'>
                            <input type="text" class="form-control" placeholder='Cari nama..' name='search'>
                            <button type="submit" class='btn btn-primary ml-2'>Cari</button>
                        </form>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <tr>
                                <th>NIM</th>
                                <th>Nama</th>
                                <th>Program Studi</th>
                                <th>Action</th>
                            </tr>
                            @foreach($mhs as $data)
                            <tr>
                                <td>{{$data->nim}}</td>
                                <td>{{$data->first_name}} {{ $data->last_name }}</td>
                                <td>{{$data->prodi}}</td>
                                <td>
                                    <a href="/mahasiswa/{{$data->id_mhs}}/edit"><button class="btn btn-warning">Edit</button></a>
                                    <a href="/mahasiswa/{{$data->id_mhs}}/delete"><button class="btn btn-danger">Delete</button></a>
                                </td>
                            </tr>
                            @endforeach

                        </table>
                    </div>
                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->


</div> <!-- end container-fluid -->
@endsection