<!-- Modal Input Data Invoice -->
<div class="modal fade" id="invoiceModal" tabindex="-1" aria-labelledby="invoiceModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('invoices.create') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="invoiceModalLabel">Buat Invoice</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="namaMitra" class="form-label">Nama Mitra</label>
                        <input type="text" class="form-control" id="namaMitra" name="nama_mitra"
                            placeholder="Masukkan Nama Mitra" required>
                    </div>
                    <div class="mb-3">
                        <label for="alamatMitra" class="form-label">Alamat Mitra</label>
                        <input type="text" class="form-control" id="alamatMitra" name="alamat_mitra"
                            placeholder="Masukkan Alamat Mitra" required>
                    </div>
                    <div class="mb-3">
                        <label for="kelurahan" class="form-label">Kelurahan</label>
                        <input type="text" class="form-control" id="kelurahan" name="kelurahan"
                            placeholder="Masukkan Kelurahan" required>
                    </div>
                    <div class="mb-3">
                        <label for="kecamatan" class="form-label">Kecamatan</label>
                        <input type="text" class="form-control" id="kecamatan" name="kecamatan"
                            placeholder="Masukkan Kecamatan" required>
                    </div>
                    <div class="mb-3">
                        <label for="namaAset" class="form-label">Nama Aset</label>
                        <input type="text" class="form-control" id="namaAset" name="nama_aset"
                            placeholder="Masukkan Nama Aset" required>
                    </div>
                    <div class="mb-3">
                        <label for="nilai" class="form-label">Nilai</label>
                        <input type="number" class="form-control" id="nilai" name="nilai"
                            placeholder="Masukkan Nilai" required>
                    </div>
                    <div class="mb-3">
                        <label for="ttd" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="ttd" name="ttd"
                            placeholder="Masukkan Nama Penandatangan" required>
                    </div>
                    <div class="mb-3">
                        <label for="jabatan" class="form-label">Jabatan</label>
                        <input type="text" class="form-control" id="jabatan" name="jabatan"
                            placeholder="Masukkan Jabatan Penandatangan" required>
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