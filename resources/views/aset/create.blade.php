@extends('layouts.app')

@section('title', 'Tambah Data Aset')

@section('content')
    <div class="container">
        <h1>Tambah Data Aset</h1>
        <form action="{{ route('aset.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @include('components.form-group', [
                'id' => 'no_kontrak',
                'label' => 'Kode Aset',
                'name' => 'no_kontrak',
                'placeholder' => 'Masukkan Kode Aset',
                'required' => true
            ])
            @include('components.form-group', [
                'id' => 'objek_kerjasama',
                'label' => 'Objek Kerjasama',
                'name' => 'objek_kerjasama',
                'placeholder' => 'Masukkan Objek Kerjasama',
                'required' => true
            ])
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
            @include('components.form-group', [
                'id' => 'alamat',
                'label' => 'Alamat Lengkap',
                'name' => 'alamat',
                'placeholder' => 'Masukkan Alamat Lengkap',
                'required' => true
            ])
            <div class="mb-3">
                <label for="skema_kerjasama">Skema Kerjasama</label>
                <select class="form-control" name="skema_kerjasama" id="skema_kerjasama" required>
                    <option value="" disabled>Pilih opsi</option>
                    <option value="Jual">Jual</option>
                    <option value="KSU">KSU</option>
                    <option value="Sewa">Sewa</option>
                </select>
            </div>
            @include('components.form-group', [
                'id' => 'mitra',
                'label' => 'Nama Mitra',
                'name' => 'mitra',
                'placeholder' => 'Masukkan Nama Mitra',
                'required' => true
            ])
            @include('components.form-group', [
                'id' => 'bidang_usaha',
                'label' => 'Bidang Usaha Mitra',
                'name' => 'bidang_usaha',
                'placeholder' => 'Masukkan Bidang Usaha',
                'required' => true
            ])
            @include('components.form-group', [
                'id' => 'luas_objek',
                'label' => 'Luas Objek (Satuan m²)',
                'name' => 'luas_objek',
                'placeholder' => 'Masukkan Luas Objek',
                'required' => true
            ])
            @include('components.form-group', [
                'id' => 'nilai_kontrak',
                'label' => 'Nilai Kontrak',
                'name' => 'nilai_kontrak',
                'type' => 'number',
                'placeholder' => 'Masukkan Nilai Kontrak',
                'required' => true
            ])
            @include('components.form-group', [
                'id' => 'tgl_mulai',
                'label' => 'Tanggal Mulai',
                'name' => 'tgl_mulai',
                'type' => 'date',
                'required' => true
            ])
            @include('components.form-group', [
                'id' => 'tgl_berakhir',
                'label' => 'Tanggal Berakhir',
                'name' => 'tgl_berakhir',
                'type' => 'date',
                'required' => true
            ])
            @include('components.form-group', [
                'id' => 'no_nik',
                'label' => 'No NIK',
                'name' => 'no_nik',
                'placeholder' => 'Masukkan No NIK',
                'required' => true
            ])
            @include('components.form-group', [
                'id' => 'no_kk',
                'label' => 'No KK',
                'name' => 'no_kk',
                'placeholder' => 'Masukkan No KK',
                'required' => true
            ])
            @include('components.form-group', [
                'id' => 'no_npwp',
                'label' => 'No NPWP',
                'name' => 'no_npwp',
                'placeholder' => 'Masukkan No NPWP',
                'required' => true
            ])
            @include('components.form-group', [
                'id' => 'tgl_bayar',
                'label' => 'Tanggal Bayar',
                'name' => 'tgl_bayar',
                'type' => 'date',
                'required' => true
            ])
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
            <div class="mb-3">
                <label for="foto_ktp">Foto KTP</label>
                <input type="file" class="form-control" id="foto_ktp" name="foto_ktp" accept="image/*" required>
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
        function toggleInput() {
        var option = document.getElementById('file_kmz_option').value;
        if (option === 'upload') {
            document.getElementById('file_kmz_upload').style.display = 'block';
            document.getElementById('coordinate_input').style.display = 'none';
        } else if (option === 'coordinate') {
            document.getElementById('file_kmz_upload').style.display = 'none';
            document.getElementById('coordinate_input').style.display = 'block';
        } else {
            document.getElementById('file_kmz_upload').style.display = 'none';
            document.getElementById('coordinate_input').style.display = 'none';
        }
    }
    // Fungsi untuk inisialisasi peta
    function initMap() {
        // Lokasi default (bisa disesuaikan sesuai kebutuhan)
        var defaultLocation = {
            lat: -7.250445,
            lng: 112.768845
        };

        // Membuat peta baru
        var map = new google.maps.Map(document.getElementById("map-koordinat"), {
            zoom: 13,
            center: defaultLocation,
        });

        // Membuat marker untuk menunjukkan titik yang dipilih
        var marker = new google.maps.Marker({
            position: defaultLocation,
            map: map,
            draggable: true // marker dapat digeser oleh pengguna
        });

        // Menampilkan koordinat default di input (jika diperlukan)
        document.getElementById("latitude").value = defaultLocation.lat;
        document.getElementById("longitude").value = defaultLocation.lng;

        // Menangkap event klik pada peta
        map.addListener("click", function(event) {
            // Mendapatkan lokasi klik
            var clickedLocation = event.latLng;

            // Memindahkan marker ke lokasi baru
            marker.setPosition(clickedLocation);

            // Memperbarui input latitude dan longitude
            document.getElementById("latitude").value = clickedLocation.lat();
            document.getElementById("longitude").value = clickedLocation.lng();
        });

        // Event ketika marker digeser
        marker.addListener('dragend', function(event) {
            // Memperbarui input saat marker digeser
            document.getElementById("latitude").value = event.latLng.lat();
            document.getElementById("longitude").value = event.latLng.lng();
        });
    }
    </script>
    <script async defer
        src="https://maps.googleapis.com/maps/api/js?key={{ENV('GOOGLE_MAP_API_KEY')}}&callback=initMap">
@endsection
