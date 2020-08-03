@extends('layouts.app')

@section("head_title", "Dashboard")
@section("title")
<div class="container-fluid">
    <!-- Page-Title -->
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box" id="breadcrumb">
                <h4 class="page-title">Beranda</h4>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active">
                        Dashboard
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

                    <h4 class="mt-0 header-title">Dashboard Mahasiswa {{ $user->full_name }}</h4>
                    <p class="text-muted m-b-30 font-14">Berikut adalah rekap seluruh data</p>
                    @if(session('success'))
                    <div class="alert alert-success">
                        {{session('success')}}
                    </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <tr>
                                <td>Total Konsultasi Hari Ini</td>
                                <td>{{ $data['totalKonsultasiToday'] }} Konsultasi Hari Ini</td>
                                <td><a href='{{ route("konsultasi.index") }}'><i class='ti ti-eye'></i> Lihat</a></td>
                            </tr>
                        </table>
                        <br><br>
                        <table class="table table-bordered">
                            <tr>
                                <th>#</th>
                                <th>Nama Mahasiswa</th>
                                <th>Judul</th>
                                <th>Tanggal</th>
                                <th>Keterangan</th>
                                <th>Nama Dosen Pembimbing</th>
                                @if( Auth::user()->userable_type == 'App\Mahasiswa' )
                                @endif
                            </tr>
                            @foreach($konsultasis as $konsultasi)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $konsultasi->mahasiswa->full_name }}</td>
                                <td>{{ $konsultasi->judul }}</td>
                                <td>{{ $konsultasi->tanggal->format('d-M-Y | H:i') }}</td>
                                <td>{{ $konsultasi->keterangan }}</td>
                                <td>{{ $konsultasi->dosen->full_name }}</td>
                                @endforeach
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