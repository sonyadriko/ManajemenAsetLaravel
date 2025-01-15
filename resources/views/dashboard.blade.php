@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="container-xxl">
        <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
            <div class="flex-grow-1">
                <h4 class="fs-18 fw-semibold m-0">Dashboard</h4>
            </div>
            <!-- Tombol Buat Invoice -->
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#invoiceModal">
                Buat Invoice
            </button>
        </div>

        <div class="row">
            <div class="col-md-6 col-xl-3 mb-4">
                <div class="card h-100">
                    <div class="card-body d-flex flex-column justify-content-between" style="height: 100%">
                        <p class="text-muted mb-3 fw-semibold text-center">Total Aset yang akan berakhir dalam 1 bulan</p>
                        <h4 class="m-0 fs-18 text-center">
                            <a href="{{ route('aset.alert') }}" class="text-decoration-none">{{ $total_assets }} Aset</a>
                        </h4>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-3 mb-4">
                <div class="card h-100">
                    <div class="card-body d-flex flex-column justify-content-between" style="height: 100%">
                        <p class="text-muted mb-3 fw-semibold text-center">Total Aset Keseluruhan</p>
                        <h4 class="m-0 fs-18 text-center">{{ $total_assets_all }} Aset</h4>
                    </div>
                </div>
            </div>
        </div>

    </div>

    @include('components.invoice-modal')
@endsection
