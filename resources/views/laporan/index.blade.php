@extends('layouts.app')

@section("head_title", "Laporan")
@section("title")
<div class="container-fluid">
    <!-- Page-Title -->
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box" id="breadcrumb">
                <h4 class="page-title">Laporan</h4>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active">
                        Data Master
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

                    <h4 class="mt-0 header-title">Laporan Admin</h4>
                    <p class="text-muted m-b-30 font-14">Berikut adalah rekap seluruh data</p>
                    @if(session('success'))
                    <div class="alert alert-success">
                        {{session('success')}}
                    </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <tr>
                                <td>Total Konsultasi</td>
                                <td><a href=''><i class='ti ti-import'></i> Lihat</a></td>
                            </tr>
                            <tr>
                                <td>Total Dosen</td>
                                <td><a href=''><i class='ti ti-import'></i> Lihat</a></td>
                            </tr>
                            <tr>
                                <td>Total Mahasiswa</td>
                                <td><a href=''><i class='ti ti-import'></i> Lihat</a></td>
                            </tr>
                            <tr>
                                <td>Total Admin</td>
                                <td><a href=''><i class='ti ti-import'></i> Lihat</a></td>
                            </tr>
                            <tr>
                                <td>Total Konsultasi Hari Ini</td>
                                <td><a href=''><i class='ti ti-import'></i> Lihat</a></td>
                            </tr>
                        </table>
                    </div>

                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->



</div> <!-- end container-fluid -->
@endsection
@push('styles')
<style>
    ul {
        padding-left: 15px !important;
        margin-bottom: 0;
    }
</style>
@endpush
@push('scripts')
<script>
    function getData() {

    }
</script>
@endpush