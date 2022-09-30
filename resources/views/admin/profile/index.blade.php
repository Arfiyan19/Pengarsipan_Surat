@extends('layouts.layout')
@section('title', 'About')
@section('content')
{{-- card --}}
<div class="col-lg-12">
    <div class="card shadow-sm mb-2">
        <br>
        <div class="card-header py-1">
            <h5 class="m-0 font-weight-bold text-primary">@yield('title')</h6>
        </div>
        <br>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-12 col-md-10">
                    <div class="card shadow-sm mb-2">
                        <div class="card-body">
                            <h5>Aplikasi ini Dibuat Oleh:</h5>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 col-md-6">
                    <div class="card shadow-sm mb-4">

                        <div class="card-body">
                            {{-- foto --}}
                            <div class="row">
                                <div class="col-lg-4 col-md-6">
                                    <div class="card shadow-sm mb-4">
                                        <div class="card-body">
                                            <img src="{{ asset('storage/picture/ARFIYAN FOTO.JPG') }}" class="img-fluid" alt="Responsive image">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-4">
                                    <h5>Nama : Arfiyan Wahyu Pratama</h5>
                                    <h5>NIM : 2141764049</h5>
                                    <h5>Kelas : SIB 3D</h5>
                                    <h5>Tanggal : 29 September 2022</h5>
                                </div>
                            </div>
                            {{-- end foto --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- end card --}}

@endsection