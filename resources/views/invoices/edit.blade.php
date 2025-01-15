@extends('layouts.app')

@section('title', 'Edit Invoice')

@section('content')
    <div class="container">
        <h1>Edit Invoice</h1>
        <form action="{{ route('invoices.update', $invoice->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="namaMitra" class="form-label">Nama Mitra</label>
                <input type="text" class="form-control" id="namaMitra" name="nama_mitra" value="{{ $invoice->nama_mitra }}" required>
            </div>
            <div class="mb-3">
                <label for="alamatMitra" class="form-label">Alamat Mitra</label>
                <input type="text" class="form-control" id="alamatMitra" name="alamat_mitra" value="{{ $invoice->alamat_mitra }}" required>
            </div>
            <div class="mb-3">
                <label for="kelurahan" class="form-label">Kelurahan</label>
                <input type="text" class="form-control" id="kelurahan" name="kelurahan" value="{{ $invoice->kelurahan }}" required>
            </div>
            <div class="mb-3">
                <label for="kecamatan" class="form-label">Kecamatan</label>
                <input type="text" class="form-control" id="kecamatan" name="kecamatan" value="{{ $invoice->kecamatan }}" required>
            </div>
            <div class="mb-3">
                <label for="namaAset" class="form-label">Nama Aset</label>
                <input type="text" class="form-control" id="namaAset" name="nama_aset" value="{{ $invoice->nama_aset }}" required>
            </div>
            <div class="mb-3">
                <label for="nilai" class="form-label">Nilai</label>
                <input type="number" class="form-control" id="nilai" name="nilai" value="{{ $invoice->nilai_kontrak }}" required>
            </div>
            <div class="mb-3">
                <label for="ttd" class="form-label">Nama Penandatangan</label>
                <input type="text" class="form-control" id="ttd" name="ttd" value="{{ $invoice->ttd }}" required>
            </div>
            <div class="mb-3">
                <label for="jabatan" class="form-label">Jabatan</label>
                <input type="text" class="form-control" id="jabatan" name="jabatan" value="{{ $invoice->jabatan }}" required>
            </div>
            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        </form>
    </div>
@endsection
