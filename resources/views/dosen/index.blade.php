@extends('layouts.app')

@section("head_title", "Daftar Dosen")
@section("title")
<div class="container-fluid">
    <!-- Page-Title -->
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box" id="breadcrumb">
                <h4 class="page-title">Dosen</h4>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active">
                        Menampilkan seluruh data dosen
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

                    <h4 class="mt-0 header-title">Dosen</h4>
                    <p class="text-muted m-b-30 font-14">Berikut adalah data seluruh dosen</p>
                    @if(session('success'))
                    <div class="alert alert-success">
                        {{session('success')}}
                    </div>
                    @endif
                    <div class="card-actions ">
                        <a class='btn btn-primary float-left' href="{{ route('dosen.create') }}"><i class='ti ti-plus'></i> Tambah Dosen</a><br>
                        
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <tr>
                                <th>ID</th>
                                <th>Nama</th>
                                <th>NIP</th>
                                <th>Prodi</th>
                                <th>Aksi</th>
                            </tr>
                            @foreach($dosens as $dosen)
                            <tr>
                                <td>{{ $dosen->id }}</td>
                                <td>{{ $dosen->first_name }} {{ $dosen->last_name }}</td>
                                <td>{{ $dosen->nip }}</td>
                                <td>{{ $dosen->prodi }}</td>
                                <td>
                                    <div class="d-inline-flex">
                                        <a href="{{ route('dosen.edit', ['dosen' => $dosen->id]) }}" class='btn btn-warning mr-2'>Edit</a>
                                        
                                        <form action="{{ route('dosen.destroy', ['dosen' => $dosen->id]) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" onclick="return confirm('Apakah Anda yakin ingin menghapus?')" class='btn btn-danger'>Delete</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                            @forelse($dosens as $dosen)
                            @empty
                            <tr>
                                <td colspan="6">Tidak ada data</td>
                            </tr>
                            @endforelse
                        </table>
                    </div>

                </div>
            </div>
        </div> <!-- end col -->
    </div>
 
    
 <!-- end row -->


</div> <!-- end container-fluid -->
@endsection

