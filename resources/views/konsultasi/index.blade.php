@extends('layouts.app')

@section("head_title", "Konsultasi ")
@section("title")
<div class="container-fluid">
    <!-- Page-Title -->
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box" id="breadcrumb">
                <h4 class="page-title">Konsultasi</h4>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active">
                        Menampilkan seluruh data konsultasi
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

                    <h4 class="mt-0 header-title">Konsultasi</h4>
                    <p class="text-muted m-b-30 font-14">Berikut adalah data seluruh konsultasi</p>
                    @if(session('success'))
                    <div class="alert alert-success">
                        {{session('success')}}
                    </div>
                    @endif
                    <div class="card-actions ">
                        <a class='btn btn-primary float-left' href="{{ route('konsultasi.create') }}"><i class='ti ti-plus'></i> Tambah Konsultasi</a>
                        <form action="" method="get" class='form-inline float-right mb-3'>
                            <input type="text" class="form-control" placeholder='Cari nama..' name='search'>
                            <button type="submit" class='btn btn-primary ml-2'>Cari</button>
                        </form>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <tr>
                                <th>ID</th>
                                <th>Nama Mahasiswa</th>
                                <th>Judul</th>
                                <th>Tanggal</th>
                                <th>Keterangan</th>
                                <th>Nama Dosen Pembimbing</th>
                                <th>Aksi</th>
                            </tr>
                            @foreach($konsultasis as $konsultasi)
                            <tr>
                                <td>{{ $konsultasi->id }}</td>
                                <td>{{ $konsultasi->mahasiswa->full_name }}</td>
                                <td>{{ $konsultasi->judul }}</td>
                                <td>{{ $konsultasi->tanggal->format('d-M-Y | H:i') }}</td>
                                <td>{{ $konsultasi->keterangan }}</td>
                                <td>{{ $konsultasi->dosen->full_name }}</td>
                                <td>
                                    <div class="d-inline-flex">
                                        <a href="{{ route('konsultasi.edit', ['konsultasi' => $konsultasi->id]) }}" class='btn btn-warning mr-2'>Edit</a>
                                        <form action="{{ route('konsultasi.destroy', ['konsultasi' => $konsultasi->id]) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class='btn btn-danger'>Delete</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </table>
                    </div>
                    {{$konsultasis->links()}}
                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->


</div> <!-- end container-fluid -->
@endsection