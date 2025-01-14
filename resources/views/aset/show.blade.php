@extends('layouts.app')

@section('title', 'Detail Aset')

@section('content')
    <style>
        .lightbox {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.8);
            justify-content: center;
            /* Memastikan konten di tengah */
            align-items: center;
            /* Memastikan konten di tengah */
        }

        .lightbox-content {
            margin: auto;
            display: block;
            max-width: 100%;
            max-height: 100%;
        }

        .lightbox-content img {
            width: auto;
            height: 80vh;
            /* Maksimal tinggi gambar */
            max-width: 100%;
        }

        .close {
            position: absolute;
            top: 10px;
            right: 25px;
            color: #fff;
            font-size: 35px;
            font-weight: bold;
            transition: 0.3s;
        }

        .close:hover,
        .close:focus {
            color: #bbb;
            text-decoration: none;
            cursor: pointer;
        }
    </style>
    <div class="container">
        <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
            <div class="flex-grow-1">
                <h4 class="fs-18 fw-semibold m-0">Detail Aset</h4>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 col-xl-12">
                <div class="card">
                    <div class="card-body">
                        @if ($aset)
                            <table class="table table-bordered">
                                <tr>
                                    <th>Kode Aset</th>
                                    <td>{{ $aset->no_kontrak ?? 'NULL' }}</td>
                                </tr>
                                <tr>
                                    <th>Objek Kerjasama</th>
                                    <td>{{ $aset->objek_kerjasama ?? 'NULL' }}</td>
                                </tr>
                                <tr>
                                    <th>Provinsi</th>
                                    <td>{{ $aset->nama_provinsi ?? 'NULL' }}</td>
                                </tr>
                                <tr>
                                    <th>Kabupaten</th>
                                    <td>{{ $aset->nama ?? 'NULL' }}</td>
                                </tr>
                                <tr>
                                    <th>Kecamatan</th>
                                    <td>{{ $aset->kecamatan_nama ?? 'NULL' }}</td>
                                </tr>
                                <tr>
                                    <th>Alamat Lengkap</th>
                                    <td>{{ $aset->alamat ?? 'NULL' }}</td>
                                </tr>
                                <tr>
                                    <th>Skema Kerjasama</th>
                                    <td>{{ $aset->skema_kerjasama ?? 'NULL' }}</td>
                                </tr>
                                <tr>
                                    <th>Nama Mitra</th>
                                    <td>{{ $aset->mitra ?? 'NULL' }}</td>
                                </tr>
                                <tr>
                                    <th>Bidang Usaha Mitra</th>
                                    <td>{{ $aset->bidang_usaha ?? 'NULL' }}</td>
                                </tr>
                                <tr>
                                    <th>Luas Objek (Satuan m&sup2;)</th>
                                    <td>{{ $aset->luas_objek ?? 'NULL' }}</td>
                                </tr>
                                <tr>
                                    <th>Nilai Kontrak</th>
                                    <td>
                                        @if ($aset->nilai_kontrak)
                                            Rp {{ number_format($aset->nilai_kontrak, 0, ',', '.') }}
                                        @else
                                            NULL
                                        @endif
                                    </td>
                                </tr>

                                <tr>
                                    <th>Tanggal Mulai</th>
                                    <td>{{ $aset->tgl_mulai ?? 'NULL' }}</td>
                                </tr>
                                <tr>
                                    <th>Tanggal Berakhir</th>
                                    <td>{{ $aset->tgl_berakhir ?? 'NULL' }}</td>
                                </tr>
                                <tr>
                                    <th>No NIK</th>
                                    <td>{{ $aset->no_nik ?? 'NULL' }}</td>
                                </tr>
                                <tr>
                                    <th>No KK</th>
                                    <td>{{ $aset->no_kk ?? 'NULL' }}</td>
                                </tr>
                                <tr>
                                    <th>No NPWP</th>
                                    <td>{{ $aset->no_npwp ?? 'NULL' }}</td>
                                </tr>
                                <tr>
                                    <th>Tanggal Bayar</th>
                                    <td>{{ $aset->tgl_bayar ?? 'NULL' }}</td>
                                </tr>
                                <tr>
                                    <th>Berkas SHP (PDF)</th>
                                    <td>
                                        @if (!empty($aset->berkas_shp))
                                            <embed src="{{ asset('storage/' . $aset->berkas_shp) }}" type="application/pdf"
                                                width="100%" height="600px" />
                                        @else
                                            NULL
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Berkas PKS (PDF)</th>
                                    <td>
                                        @if (!empty($aset->berkas_pks))
                                            <embed src="{{ asset('storage/' . $aset->berkas_pks) }}" type="application/pdf"
                                                width="100%" height="600px" />
                                        @else
                                            NULL
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Foto NPWP</th>
                                    <td>
                                        @if (!empty($aset->foto_npwp))
                                            <img src="{{ asset('storage/' . $aset->foto_npwp) }}" alt="Foto NPWP"
                                                style="max-width: 100px; height: auto; cursor: pointer;"
                                                onclick="openLightbox('{{ asset('storage/' . $aset->foto_npwp) }}')">
                                        @else
                                            NULL
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Foto KTP</th>
                                    <td>
                                        @if (!empty($aset->foto_ktp))
                                            <img src="{{ asset('storage/' . $aset->foto_ktp) }}" alt="Foto KTP"
                                                style="max-width: 100px; height: auto; cursor: pointer;"
                                                onclick="openLightbox('{{ asset('storage/' . $aset->foto_ktp) }}')">
                                        @else
                                            NULL
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>File KMZ</th>
                                    <td>
                                        @if (!empty($aset->file_kmz))
                                            <a href="{{ asset($aset->file_kmz) }}" target="_blank">Download</a>
                                        @else
                                            NULL
                                        @endif
                                    </td>
                                </tr>
                            </table>
                            {{-- Mengecek apakah file KMZ ada dan menghasilkan URL --}}
                            @php
                                // Memastikan $aset adalah objek dan akses data menggunakan notasi objek
                                $kmzFileUrl = !empty($aset->file_kmz) ? asset('storage/' . $aset->file_kmz) : null;
                            @endphp

                            {{-- Menampilkan peta jika latitude dan longitude ada --}}
                            @if (!empty($aset->latitude) && !empty($aset->longitude))
                                <div id="map" style="height: 500px; width: 100%;"></div>
                            @endif




                            <a href="{{ route('aset.index') }}" class="btn btn-secondary mt-2">Kembali</a>
                        @else
                            <p>Aset tidak ditemukan.</p>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="lightbox" class="lightbox">
        <span class="close" onclick="closeLightbox()">&times;</span>
        <img class="lightbox-content" id="lightbox-img">
    </div>
    <script>
        var latitude = <?= json_encode($aset->latitude ?? null) ?>;
        var longitude = <?= json_encode($aset->longitude ?? null) ?>;
        var kmzFileUrl = <?= json_encode($kmzFileUrl) ?>;

        function initMap() {
            var latitude = <?= json_encode($aset->latitude ?? 'null') ?>;
            var longitude = <?= json_encode($aset->longitude ?? 'null') ?>;
            var kmzFileUrl = <?= json_encode($kmzFileUrl) ?>;

            console.log(kmzFileUrl);

            var location = {
                lat: parseFloat(latitude),
                lng: parseFloat(longitude)
            };

            // Initialize the map
            var mapDiv = document.getElementById("map");
            if (!mapDiv) {
                console.error("Map div not found!");
                return;
            }

            var map = new google.maps.Map(mapDiv, {
                zoom: 15,
                center: location
            });

            // Add a marker at the location
            new google.maps.Marker({
                position: location,
                map: map,
                title: "Lokasi Aset"
            });
        }
    </script>
    <script>
        function openLightbox(src) {
            var lightbox = document.getElementById('lightbox');
            var lightboxImg = document.getElementById('lightbox-img');
            lightbox.style.display = 'block';
            lightboxImg.src = src;
        }

        function closeLightbox() {
            var lightbox = document.getElementById('lightbox');
            lightbox.style.display = 'none';
        }
    </script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key={{ ENV('GOOGLE_MAP_API_KEY') }}&callback=initMap">
    @endsection
