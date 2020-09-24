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
                            <label for="example-text-input" class="col-sm-2 col-form-label">Nama Depan</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" placeholder="Masukkan nama" name='first_name' value="{{ $mahasiswa->first_name }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="example-text-input" class="col-sm-2 col-form-label">Nama Belakang</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" placeholder="Masukkan nama" name='last_name' value="{{ $mahasiswa->last_name }}">
                            </div>
                        </div>
                        <div class=" form-group row">
                            <label for="example-text-input" class="col-sm-2 col-form-label">NIM</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" placeholder="NIM" name='nim' value="{{ $mahasiswa->nim }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="example-text-input" class="col-sm-2 col-form-label">Pilih Program Studi</label>
                            <div class="col-sm-10">
                                <select class="form-control" name="prodi" required="" value="{{ $mahasiswa->prodi }}">
                                    <option value=" null" disabled selected>- Pilih -</option>
                                    <option value="TIF">Teknik Informatika</option>
                                    <option value="TI">Teknik Industri</option>
                                    <option value="TS">Teknik Sipil</option>
                                    <option value="TE">Teknik Elektro</option>
                                    <option value="TG">Teknik Geologi</option>
                                </select>
                            </div>
                        </div>
                        <hr />
                        <div class="form-group row">
                            <label for="example-text-input" class="col-sm-2 col-form-label">Username</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" placeholder="Username" name='username' value="{{ $user->username }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="example-text-input" class="col-sm-2 col-form-label">Password</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="password" placeholder="password" name='password' value="{{ $user->password }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="example-text-input" class="col-sm-2 col-form-label">Email</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" placeholder="Email" name='email' value="{{ $user->email }}">
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