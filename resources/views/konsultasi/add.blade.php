@extends('layouts.app')

@section("head_title", "Konsultasi")
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

                    <h4 class="mt-0 mb-4 header-title">Tambah Konsultasi</h4>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="{{ route('konsultasi.store') }}" method="post">
                        @csrf
                        
                        <div class="form-group row">
                            <label for="example-text-input" class="col-sm-2 col-form-label">Nama Mahasiswa</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" name='user' id="user" value="{{ $user->userable->nim }} || {{ $user->userable->full_name }}" disabled>
                            </div>
                        </div>
                        @if($konsultasi)
                        <div class="form-group row">
                            <label for="example-text-input" class="col-sm-2 col-form-label">Nama Dosen</label>
                            <div class="col-sm-10">
                            <input class="form-control" type="text" name='dosen' id="dosen" value="{{ $konsultasi->dosen_id }}" hidden>{{ $konsultasi->dosen->full_name }} || {{ $konsultasi->dosen->nip }}</input>
                            <!-- <input class="form-control" type="text" name='dosen' id="dosen" value="{{ $konsultasi->dosen->dosen_id }}" hidden>
                            <input class="form-control"  value="{{ $konsultasi->dosen->full_name }} || {{ $konsultasi->dosen->nip }}" readonly> -->
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="example-text-input" class="col-sm-2 col-form-label">Judul</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" placeholder="Judul" name='judul' value="{{ $konsultasi->judul }}" readonly>
                            </div>
                        </div>
                        @endif
                        @if(!$konsultasi)
                        <div class="form-group row">
                            <label for="example-text-input" class="col-sm-2 col-form-label">Nama Dosen</label>
                            <div class="col-sm-10">
                                <select name="dosen" id="dosen" class="form-control">
                                    @foreach($dosen as $dosen)
                                    <option value="{{$dosen->id}}">{{ $dosen->full_name }} || {{ $dosen->nip }} || {{ $dosen->prodi }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="example-text-input" class="col-sm-2 col-form-label">Judul</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" placeholder="Judul" name='judul'>
                            </div>
                        </div>
                        @endif
                        <div class="form-group row">
                            <label for="example-text-input" class="col-sm-2 col-form-label">Tanggal</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="date" placeholder="" name='tanggal'>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="example-text-input" class="col-sm-2 col-form-label">Keterangan</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" placeholder="Masukkan catatan" name='keterangan'>
                            </div>
                        </div>
                        <button type="submit" class='btn btn-primary float-right'>Submit</button>
                    </form>
                    
                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->


</div> <!-- end container-fluid -->
@endsection