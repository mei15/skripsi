@extends('layouts.app')

@section("head_title", "Daftar Pengguna")
@section("title")
<div class="container-fluid">
    <!-- Page-Title -->
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box" id="breadcrumb">
                <h4 class="page-title">Pengguna</h4>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active">
                        Menampilkan seluruh data pengguna
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

                    <h4 class="mt-0 mb-4 header-title">Ubah Dosen</h4>
                    <form action="{{ route('dosen.update', ['dosen' => $dosen->id]) }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="form-group row">
                            <label for="example-text-input" class="col-sm-2 col-form-label">Nama Dosen</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" placeholder="Masukkan nama" name='nama' id="example-text-input" value="{{ $dosen->nama }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="example-text-input" class="col-sm-2 col-form-label">NIP</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" placeholder="NIP" name='nip' id="example-text-input" value="{{ $dosen->nip }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="example-text-input" class="col-sm-2 col-form-label">Pilih Program Studi</label>
                            <div class="col-sm-10">
                                <select class="form-control" name="prodi" required="" value="{{ $dosen->prodi }}">
                                    <option value=""></option>
                                    <option value="TIF">Teknik Informatika</option>
                                    <option value="TI">Teknik Industri</option>
                                    <option value="TS">Teknik Sipil</option>
                                    <option value="TE">Teknik Elektro</option>
                                    <option value="TG">Teknik Geologi</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="example-text-input" class="col-sm-2 col-form-label">Pilih Nama</label>
                            <div class="col-sm-10">
                                <select name="user" id="user" class="form-control">
                                    @foreach($users as $user)
                                    <option value="{{ $user->id }}" {{$dosen->id_user == $user->id ? 'selected' : ''}}>{{ $user->username }}</option>
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