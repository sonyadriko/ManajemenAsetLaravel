@extends('layouts.app')

@section('title', 'Data Aset')

@section('content')
    <div class="container">
        <h1>Data Aset</h1>
        <a href="{{ route('aset.create') }}" class="btn btn-success">Tambah Data Aset</a>
        <a href="{{ route('aset.export') }}" class="btn btn-success">Export to Excel</a>
        <table class="table table-striped mt-4">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kode Aset</th>
                    <th>Objek Kerjasama</th>
                    <th>Nama Mitra</th>
                    <th>Tanggal Mulai</th>
                    <th>Tanggal Berakhir</th>
                    <th>Update Terakhir</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($dataAset as $key => $aset)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $aset->no_kontrak }}</td>
                        <td>{{ $aset->objek_kerjasama }}</td>
                        <td>{{ $aset->mitra }}</td>
                        <td>{{ $aset->tgl_mulai }}</td>
                        <td>{{ $aset->tgl_berakhir }}</td>
                        <td>{{ $aset->updated_at }}</td>
                        <td>
                            <a href="#" class="btn btn-primary">Detail</a>
                            <a href="#" class="btn btn-warning">Edit</a>
                            <a href="#" class="btn btn-danger">Delete</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
