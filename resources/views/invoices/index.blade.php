@extends('layouts.app')

@section('title', 'Data Invoice')

@section('content')
    <div class="container">
        <h1>Data Invoice</h1>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#invoiceModal">
            Buat Invoice
        </button>
        <table class="table table-striped mt-4">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nomor Kontrak</th>
                    <th>Nomor Invoice</th>
                    <th>Nama Mitra</th>
                    <th>Tanggal</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($invoice as $key => $invoice)
                    <tr>
                        <td class="text-center">{{ $key + 1 }}</td>
                        <td>{{ $invoice->no_kontrak }}</td>
                        <td>{{ $invoice->no_invoice }}</td>
                        <td>{{ $invoice->nama_mitra }}</td>
                        <td>{{ $invoice->created_at }}</td>
                        <td>
                            <a href="{{ route('invoices.edit', $invoice->id) }}" class="btn btn-warning d-inline">Edit</a>
                            <form action="{{ route('invoices.destroy', $invoice->id) }}" method="POST"
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
    @include('components.invoice-modal')
    <script>
        function confirmDelete() {
            return confirm('Apakah Anda yakin ingin menghapus data invoice ini?');
        }
    </script>
@endsection
