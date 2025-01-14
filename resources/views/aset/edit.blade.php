@extends('layouts.app')

@section('title', 'Edit Data Aset')

@section('content')
    <div class="container">
        <h1>Edit Data Aset</h1>
        <form action="{{ route('aset.update', $aset->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            @include('components.form-group', [
                'id' => 'no_kontrak',
                'label' => 'Kode Aset',
                'name' => 'no_kontrak',
                'value' => $aset->no_kontrak,
                'placeholder' => 'Masukkan Kode Aset',
                'required' => true,
            ])
            @include('components.form-group', [
                'id' => 'objek_kerjasama',
                'label' => 'Objek Kerjasama',
                'name' => 'objek_kerjasama',
                'value' => $aset->objek_kerjasama,
                'placeholder' => 'Masukkan Objek Kerjasama',
                'required' => true,
            ])
            <div class="mb-3">
                <label for="provinsi" class="form-label">Provinsi</label>
                <select id="provinsi" name="provinsi" class="form-control" required>
                    <option value="">Pilih Provinsi</option>
                    @foreach ($provinsi as $p)
                        <option value="{{ $p->id }}" {{ $aset->provinsi == $p->id ? 'selected' : '' }}>
                            {{ $p->nama_provinsi }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="kabupaten" class="form-label">Kota/Kabupaten</label>
                <select id="kabupaten" name="kabupaten" class="form-control" required>
                    <option value="">Pilih Kota/Kabupaten</option>
                    @foreach ($kabupaten as $k)
                        <option value="{{ $k->id }}" {{ $aset->kabupaten == $k->id ? 'selected' : '' }}>
                            {{ $k->nama }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="kecamatan" class="form-label">Kecamatan</label>
                <select id="kecamatan" name="kecamatan" class="form-control" required>
                    <option value="">Pilih Kecamatan</option>
                    @foreach ($kecamatan as $c)
                        <option value="{{ $c->id }}" {{ $aset->kecamatan == $c->id ? 'selected' : '' }}>
                            {{ $c->nama }}
                        </option>
                    @endforeach
                </select>
            </div>

            @include('components.form-group', [
                'id' => 'alamat',
                'label' => 'Alamat Lengkap',
                'name' => 'alamat',
                'value' => $aset->alamat,
                'placeholder' => 'Masukkan Alamat Lengkap',
                'required' => true,
            ])

            <div class="mb-3">
                <label for="skema_kerjasama">Skema Kerjasama</label>
                <select class="form-control" name="skema_kerjasama" id="skema_kerjasama" required>
                    <option value="" disabled>Pilih opsi</option>
                    <option value="Jual" {{ $aset->skema_kerjasama == 'Jual' ? 'selected' : '' }}>Jual</option>
                    <option value="KSU" {{ $aset->skema_kerjasama == 'KSU' ? 'selected' : '' }}>KSU</option>
                    <option value="Sewa" {{ $aset->skema_kerjasama == 'Sewa' ? 'selected' : '' }}>Sewa</option>
                </select>
            </div>

            @include('components.form-group', [
                'id' => 'mitra',
                'label' => 'Nama Mitra',
                'name' => 'mitra',
                'value' => $aset->mitra,
                'placeholder' => 'Masukkan Nama Mitra',
                'required' => true,
            ])
            @include('components.form-group', [
                'id' => 'bidang_usaha',
                'label' => 'Bidang Usaha Mitra',
                'name' => 'bidang_usaha',
                'value' => $aset->bidang_usaha,
                'placeholder' => 'Masukkan Bidang Usaha',
                'required' => true,
            ])
            @include('components.form-group', [
                'id' => 'luas_objek',
                'label' => 'Luas Objek (Satuan m²)',
                'name' => 'luas_objek',
                'value' => $aset->luas_objek,
                'placeholder' => 'Masukkan Luas Objek',
                'required' => true,
            ])
            @include('components.form-group', [
                'id' => 'nilai_kontrak',
                'label' => 'Nilai Kontrak',
                'name' => 'nilai_kontrak',
                'type' => 'number',
                'value' => $aset->nilai_kontrak,
                'placeholder' => 'Masukkan Nilai Kontrak',
                'required' => true,
            ])
            @include('components.form-group', [
                'id' => 'tgl_mulai',
                'label' => 'Tanggal Mulai',
                'name' => 'tgl_mulai',
                'type' => 'date',
                'value' => $aset->tgl_mulai,
                'required' => true,
            ])
            @include('components.form-group', [
                'id' => 'tgl_berakhir',
                'label' => 'Tanggal Berakhir',
                'name' => 'tgl_berakhir',
                'type' => 'date',
                'value' => $aset->tgl_berakhir,
                'required' => true,
            ])
            <div class="mb-3">
                <label for="berkas_pks">Upload Berkas SHP (PDF)</label>
                <input type="file" class="form-control" id="berkas_shp" name="berkas_shp" accept=".pdf">
                <small>File sebelumnya: {{ $aset->berkas_shp }}</small>
            </div>
            <div class="mb-3">
                <label for="berkas_pks">Upload Berkas PKS (PDF)</label>
                <input type="file" class="form-control" id="berkas_pks" name="berkas_pks" accept=".pdf">
                <small>File sebelumnya: {{ $aset->berkas_pks }}</small>
            </div>

            <div class="mb-3">
                <label for="foto_npwp">Foto NPWP (JPG, PNG)</label>
                <input type="file" class="form-control" id="foto_npwp" name="foto_npwp" accept="image/*">
                <small>File sebelumnya: {{ $aset->foto_npwp }}</small>
            </div>
            <div class="mb-3">
                <label for="foto_npwp">Foto KTP (JPG, PNG)</label>
                <input type="file" class="form-control" id="foto_ktp" name="foto_ktp" accept="image/*">
                <small>File sebelumnya: {{ $aset->foto_ktp }}</small>
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // AJAX untuk dropdown kabupaten
            $('#provinsi').change(function() {
                var id_provinsi = $(this).val();
                if (id_provinsi != '') {
                    $.ajax({
                        url: "{{ route('get.kabupaten') }}",
                        method: "POST",
                        data: {
                            provinsi_id: id_provinsi,
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(data) {
                            var options = '<option value="">Pilih Kota/Kabupaten</option>';
                            $.each(data, function(index, kabupaten) {
                                options +=
                                    `<option value="${kabupaten.id}">${kabupaten.nama}</option>`;
                            });
                            $('#kabupaten').html(options);
                            $('#kecamatan').html('<option value="">Pilih Kecamatan</option>');
                        }
                    });
                }
            });

            // AJAX untuk dropdown kecamatan
            $('#kabupaten').change(function() {
                var id_kabupaten = $(this).val();
                if (id_kabupaten != '') {
                    $.ajax({
                        url: "{{ route('get.kecamatan') }}",
                        method: "POST",
                        data: {
                            kabupaten_id: id_kabupaten,
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(data) {
                            var options = '<option value="">Pilih Kecamatan</option>';
                            $.each(data, function(index, kecamatan) {
                                options +=
                                    `<option value="${kecamatan.id}">${kecamatan.nama}</option>`;
                            });
                            $('#kecamatan').html(options);
                        }
                    });
                }
            });
        });
    </script>
@endsection
