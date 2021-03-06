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
                    <p class="text-muted m-b-30 font-14">Berikut adalah data seluruh konsultasi Anda</p>
                   
                    
                    @if(session('success'))
                    <div class="alert alert-success">
                        {{session('success')}}
                    </div>
                    @endif
                    @if( Auth::user()->userable_type == 'App\Mahasiswa')
                    <div class="card-actions ">
                        <a class='btn btn-primary float-left' href="{{ route('konsultasi.create') }}"><i class='ti ti-plus'></i> Tambah Konsultasi</a><br>
                        
                    </div>
                    @endif
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <tr>
                                <th>No</th>
                                <th>Nama Mahasiswa</th>
                                <th>Judul</th>
                                <th>Tanggal</th>
                                <th>Keterangan</th>
                                <th>Nama Dosen Pembimbing</th>
                                @if(Auth::user()->userable_type == 'App\Mahasiswa')
                                <th>Aksi</th>
                                @endif
                            </tr>
                            @foreach($konsultasis as $konsultasi)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $konsultasi->mahasiswa->full_name }}</td>
                                <td>{{ $konsultasi->judul }}</td>
                                <td>{{ $konsultasi->tanggal->format('d-M-Y') }}</td>
                                <td>{{ $konsultasi->keterangan }}</td>
                                <td>{{ $konsultasi->dosen->full_name }}</td>
                                @if(Auth::user()->userable_type == 'App\Mahasiswa')
                                <td>
                                    <div class="d-inline-flex">
                                        <a href="{{ route('konsultasi.edit', ['konsultasi' => $konsultasi->id]) }}" class='btn btn-warning mr-2'>Edit</a>
                                                                               
                                        <form action="{{ route('konsultasi.destroy', ['konsultasi' => $konsultasi->id]) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" onclick="return confirm('Apakah Anda yakin ingin menghapus?')" class='btn btn-danger'>Delete</button>
                                        </form>
                                       
                                    </div>
                                </td>
                                @endif
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