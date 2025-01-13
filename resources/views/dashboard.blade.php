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
                        <p class="text-muted mb-3 fw-semibold text-center">Total Aset yang akan berakhir 1 bulan</p>
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

    <!-- Modal Input Data Invoice -->
    <div class="modal fade" id="invoiceModal" tabindex="-1" aria-labelledby="invoiceModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="invoiceModalLabel">Buat Invoice</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="namaMitra" class="form-label">Nama Mitra</label>
                            <input type="text" class="form-control" id="namaMitra" name="nama_mitra" placeholder="Masukkan Nama Mitra" required>
                        </div>
                        <div class="mb-3">
                            <label for="alamatMitra" class="form-label">Alamat Mitra</label>
                            <input type="text" class="form-control" id="alamatMitra" name="alamat_mitra" placeholder="Masukkan Alamat Mitra" required>
                        </div>
                        <div class="mb-3">
                            <label for="kelurahan" class="form-label">Kelurahan</label>
                            <input type="text" class="form-control" id="kelurahan" name="kelurahan" placeholder="Masukkan Kelurahan" required>
                        </div>
                        <div class="mb-3">
                            <label for="kecamatan" class="form-label">Kecamatan</label>
                            <input type="text" class="form-control" id="kecamatan" name="kecamatan" placeholder="Masukkan Kecamatan" required>
                        </div>
                        <div class="mb-3">
                            <label for="namaAset" class="form-label">Nama Aset</label>
                            <input type="text" class="form-control" id="namaAset" name="nama_aset" placeholder="Masukkan Nama Aset" required>
                        </div>
                        <div class="mb-3">
                            <label for="nilai" class="form-label">Nilai</label>
                            <input type="number" class="form-control" id="nilai" name="nilai" placeholder="Masukkan Nilai" required>
                        </div>
                        <div class="mb-3">
                            <label for="ttd" class="form-label">Nama</label>
                            <input type="text" class="form-control" id="ttd" name="ttd" placeholder="Masukkan Nama Penandatangan" required>
                        </div>
                        <div class="mb-3">
                            <label for="jabatan" class="form-label">Jabatan</label>
                            <input type="text" class="form-control" id="jabatan" name="jabatan" placeholder="Masukkan Jabatan Penandatangan" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
