@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Tambah Data Aset</h1>
        <form action="{{ route('aset.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="no_kontrak" class="form-label">Kode Aset</label>
                <input type="text" class="form-control" id="no_kontrak" name="no_kontrak" required>
            </div>

            <div class="mb-3">
                <label for="objek_kerjasama" class="form-label">Objek Kerjasama</label>
                <input type="text" class="form-control" id="objek_kerjasama" name="objek_kerjasama" required>
            </div>

            <div class="mb-3">
                <label for="provinsi" class="form-label">Provinsi</label>
                <select id="provinsi" name="provinsi" class="form-control" required>
                    <option value="">Pilih Provinsi</option>
                    @foreach ($provinsi as $p)
                        <option value="{{ $p->id }}">{{ $p->nama_provinsi }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="kabupaten" class="form-label">Kota/Kabupaten</label>
                <select id="kabupaten" name="kabupaten" class="form-control" required>
                    <option value="">Pilih Kota/Kabupaten</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="kecamatan" class="form-label">Kecamatan</label>
                <select id="kecamatan" name="kecamatan" class="form-control" required>
                    <option value="">Pilih Kecamatan</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="jalan">Alamat Lengkap</label>
                <input type="text" class="form-control" id="jalan" name="jalan" placeholder="Masukkan Nama Jalan"
                    required>
            </div>

            <div class="mb-3">
                <label for="skema_kerjasama">Skema Kerjasama</label>
                <select class="form-control" name="skema_kerjasama" id="skema_kerjasama" required>
                    <option value="" disabled>Pilih opsi</option>
                    <option value="Jual">Jual</option>
                    <option value="KSU">KSU</option>
                    <option value="Sewa">Sewa</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="mitra">Nama Mitra</label>
                <input type="text" class="form-control" id="mitra" name="mitra" placeholder="Masukkan Nama Mitra"
                    required>
            </div>

            <div class="mb-3">
                <label for="bidang_usaha">Bidang Usaha Mitra</label>
                <input type="text" class="form-control" id="bidang_usaha" name="bidang_usaha"
                    placeholder="Masukkan Bidang Usaha" required>
            </div>

            <div class="mb-3">
                <label for="luas_objek">Luas Objek (Satuan m&sup2;)</label>
                <input type="text" class="form-control" id="luas_objek" name="luas_objek"
                    placeholder="Masukkan Luas Objek" required>
            </div>

            <div class="mb-3">
                <label for="nilai_kontrak">Nilai Kontrak</label>
                <input type="number" class="form-control" id="nilai_kontrak" name="nilai_kontrak"
                    placeholder="Masukkan Nilai Kontrak" required>
            </div>

            <div class="mb-3">
                <label for="tgl_mulai">Tanggal Mulai</label>
                <input type="date" class="form-control" id="tgl_mulai" name="tgl_mulai">
            </div>

            <div class="mb-3">
                <label for="tgl_berakhir">Tanggal Berakhir</label>
                <input type="date" class="form-control" id="tgl_berakhir" name="tgl_berakhir" required>
            </div>

            <div class="mb-3">
                <label for="no_nik">No NIK</label>
                <input type="text" class="form-control" id="no_nik" name="no_nik" placeholder="Masukkan No NIK">
            </div>

            <div class="mb-3">
                <label for="no_kk">No KK</label>
                <input type="text" class="form-control" id="no_kk" name="no_kk" placeholder="Masukkan No KK"
                    required>
            </div>

            <div class="mb-3">
                <label for="no_npwp">No NPWP</label>
                <input type="text" class="form-control" id="no_npwp" name="no_npwp" placeholder="Masukkan No NPWP"
                    required>
            </div>


            <div class="mb-3">
                <label for="tgl_bayar">Tanggal Bayar</label>
                <input type="date" class="form-control" id="tgl_bayar" name="tgl_bayar" required>
            </div>

            <div class="mb-3">
                <label for="file_kmz_option">Koordinat Lokasi (titik koordinat atau
                    .KML):</label>
                <select class="form-control" id="file_kmz_option" name="file_kmz_option" required
                    onchange="toggleInput()">
                    <option value="">-- Pilih Opsi --</option>
                    <option value="upload">Upload File KMZ</option>
                    <option value="coordinate">Pilih Titik Koordinat</option>
                </select>
            </div>

            <!-- Form untuk Upload File -->
            <div class="mb-3" id="file_kmz_upload" style="display: none;">
                <label for="file_kmz">File KMZ</label>
                <input type="file" class="form-control" id="file_kmz" name="file_kmz" accept=".kmz">
            </div>

            <!-- Form untuk Pilih Titik Koordinat -->
            <div class="mb-3" id="coordinate_input" style="display: none;">
                <label for="latitude">Latitude</label>
                <input type="text" class="form-control" id="latitude" name="latitude"
                    placeholder="Masukkan Latitude" readonly>

                <label for="longitude">Longitude</label>
                <input type="text" class="form-control" id="longitude" name="longitude"
                    placeholder="Masukkan Longitude" readonly>

                <!-- Div untuk menampilkan peta Google Maps -->
                <div id="map-koordinat" style="width: 100%; height: 400px; margin-top: 10px;"></div>
            </div>

            <div class="mb-3">
                <label for="berkas_shp">Upload Invoice (PDF)</label>
                <input type="file" class="form-control" id="berkas_shp" name="berkas_shp" accept=".pdf">
            </div>

            <div class="mb-3">
                <label for="berkas_pks">Upload Berkas PKS (PDF)</label>
                <input type="file" class="form-control" id="berkas_pks" name="berkas_pks" accept=".pdf">
            </div>

            <div class="mb-3">
                <label for="foto_npwp">Foto NPWP (JPG, PNG)</label>
                <input type="file" class="form-control" id="foto_npwp" name="foto_npwp" accept="image/*" required>
            </div>

            <!-- Form lainnya sama seperti kode HTML yang sudah Anda miliki -->
            <div class="mb-3">
                <label for="foto_ktp" class="form-label">Foto KTP</label>
                <input type="file" class="form-control" id="foto_ktp" name="foto_ktp">
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Ketika provinsi dipilih
            $('#provinsi').change(function() {
                var id_provinsi = $(this).val();
                if (id_provinsi != '') {
                    $.ajax({
                        url: "{{ route('get.kabupaten') }}", // Menggunakan route Laravel
                        method: "POST",
                        data: {
                            provinsi_id: id_provinsi,
                            _token: '{{ csrf_token() }}' // Menambahkan token CSRF untuk keamanan
                        },
                        success: function(data) {
                            var options = '<option value="">Pilih Kota/Kabupaten</option>';
                            $.each(data, function(index, kabupaten) {
                                options += '<option value="' + kabupaten.id + '">' +
                                    kabupaten.nama + '</option>';
                            });
                            $('#kabupaten').html(options); // Isi dropdown kabupaten
                            $('#kecamatan').html(
                                '<option value="">Pilih Kecamatan</option>'); // Reset kecamatan
                        }
                    });
                }
            });

            // Ketika kabupaten dipilih
            $('#kabupaten').change(function() {
                var id_kabupaten = $(this).val();
                if (id_kabupaten != '') {
                    $.ajax({
                        url: "{{ route('get.kecamatan') }}", // Menggunakan route Laravel
                        method: "POST",
                        data: {
                            kabupaten_id: id_kabupaten,
                            _token: '{{ csrf_token() }}' // Menambahkan token CSRF untuk keamanan
                        },
                        success: function(data) {
                            var options = '<option value="">Pilih Kecamatan</option>';
                            $.each(data, function(index, kecamatan) {
                                options += '<option value="' + kecamatan.id + '">' +
                                    kecamatan.nama + '</option>';
                            });
                            $('#kecamatan').html(options); // Isi dropdown kecamatan
                        }
                    });
                }
            });
        });
    </script>
@endsection
