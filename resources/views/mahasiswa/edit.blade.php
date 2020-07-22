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
                        Menampilkan seluruh data Mahasiswa
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

                    <h4 class="mt-0 mb-4 header-title">Ubah Mahasiswa</h4>
                    <form action="{{ route('mahasiswa.update', ['mahasiswa' => $mahasiswa->id]) }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="form-group row">
                            <label for="example-text-input" class="col-sm-2 col-form-label">Nama Mahasiswa</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" placeholder="Masukkan nama" name='nama' id="example-text-input" value="{{ $mahasiswa->nama }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="example-text-input" class="col-sm-2 col-form-label">NIM</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" placeholder="NIM" name='nim' id="example-text-input" value="{{ $mahasiswa->nim }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="example-text-input" class="col-sm-2 col-form-label">Pilih Program Studi</label>
                            <div class="col-sm-10">
                                <select class="form-control" name="prodi" required="" value="{{ $mahasiswa->prodi }}">
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