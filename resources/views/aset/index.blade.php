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
                        <td class="text-center">{{ $key + 1 }}</td>
                        <td>{{ $aset->no_kontrak }}</td>
                        <td>{{ $aset->objek_kerjasama }}</td>
                        <td>{{ $aset->mitra }}</td>
                        <td>{{ $aset->tgl_mulai }}</td>
                        <td>{{ $aset->tgl_berakhir }}</td>
                        <td>{{ $aset->updated_at }}</td>
                        <td>
                            <a href="{{ route('aset.show', $aset->id) }}" class="btn btn-primary d-inline">Detail</a>
                            <a href="{{ route('aset.edit', $aset->id) }}" class="btn btn-warning d-inline">Edit</a>
                            <form action="{{ route('aset.destroy', $aset->id) }}" method="POST"
                                onsubmit="return confirmDelete()" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                            </form>
                        </td>

                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <script>
        function confirmDelete() {
            return confirm('Apakah Anda yakin ingin menghapus data aset ini?');
        }
    </script>
@endsection
