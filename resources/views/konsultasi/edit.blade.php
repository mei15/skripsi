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
                        Menampilkan seluruh data Konsultasi
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

                    <h4 class="mt-0 mb-4 header-title">Ubah Konsultasi</h4>
                    <form action="{{ route('konsultasi.update', $konsultasi->id) }}" method="post">
                        @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                        @csrf
                        @method('PUT')
                        <div class="form-group row">
                            <label for="example-text-input" class="col-sm-2 col-form-label">Judul</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" placeholder="Judul" name='judul' value="{{ $konsultasi->judul }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="example-text-input" class="col-sm-2 col-form-label">Tanggal</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="date" placeholder="" name='tanggal' value="{{ $konsultasi->tanggal }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="example-text-input" class="col-sm-2 col-form-label">Keterangan</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" placeholder="Masukkan catatan" name='keterangan' value="{{ $konsultasi->keterangan }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="example-text-input" class="col-sm-2 col-form-label">Nama Dosen</label>
                            <div class="col-sm-10">
                                <select name="dosen" id="dosen" class="form-control">
                                    @foreach($dosens as $dosen)
                                    <option value="{{ $dosen->id }}" {{ $konsultasi->dosen_id == $dosen->id ? 'selected' : ''}}>{{ $dosen->full_name }} || {{ $dosen->nip }}</option>
                                    @endforeach
                                </select>
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