<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataAset;
use App\Models\Provinsi;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AsetController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $dataAset = DataAset::with('provinsi', 'kabupaten', 'kecamatan')
            ->whereNull('deleted_at')
            ->orderBy('updated_at', 'DESC')
            ->get();

        return view('aset.index', compact('dataAset'));
    }

    public function create()
    {
        $provinsi = DB::table('provinsi')->get();
        $kabupaten = DB::table('kota_kabupaten')->get();
        $kecamatan = DB::table('kecamatan')->get();

        return view('aset.create', compact('provinsi', 'kabupaten', 'kecamatan'));
    }

    public function getKabupaten(Request $request)
    {
        $provinsiId = $request->input('provinsi_id');

        // Mengambil data kabupaten berdasarkan provinsi_id
        $kabupaten = DB::table('kota_kabupaten')
            ->where('provinsi_id', $provinsiId)
            ->get(['id', 'nama']);  // Mengambil id dan nama kabupaten

        // Return data kabupaten dalam bentuk HTML (option select)
        return response()->json($kabupaten);
    }

    // Method untuk mendapatkan kecamatan berdasarkan kabupaten
    public function getKecamatan(Request $request)
    {
        $kabupatenId = $request->input('kabupaten_id');

        // Mengambil data kecamatan berdasarkan kabupaten_id
        $kecamatan = DB::table('kecamatan')
            ->where('kota_kabupaten_id', $kabupatenId)
            ->get(['id', 'nama']);  // Mengambil id dan nama kecamatan

        // Return data kecamatan dalam bentuk HTML (option select)
        return response()->json($kecamatan);
    }

    public function edit($id)
    {
        $aset = DataAset::findOrFail($id);
        $provinsi = Provinsi::all(); // Ambil data provinsi
        $kabupaten = DB::table('kota_kabupaten')->get();
        $kecamatan = DB::table('kecamatan')->get();
        // dd($aset);
        return view('aset.edit', compact('aset', 'provinsi', 'kabupaten', 'kecamatan'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'no_kontrak' => 'required|string|max:255',
            'objek_kerjasama' => 'required|string|max:255',
            'provinsi' => 'required|exists:provinsi,id',
            'kabupaten' => 'required|exists:kota_kabupaten,id',
            'kecamatan' => 'required|exists:kecamatan,id',
            'alamat' => 'required|string|max:255',
            'skema_kerjasama' => 'required|string',
            'mitra' => 'required|string|max:255',
            'bidang_usaha' => 'required|string|max:255',
            'luas_objek' => 'required|numeric',
            'nilai_kontrak' => 'required|numeric',
            'tgl_mulai' => 'required|date',
            'tgl_berakhir' => 'required|date',
            'berkas_pks' => 'nullable|file|mimes:pdf|max:2048',
            'foto_npwp' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $aset = DataAset::findOrFail($id);
        $aset->no_kontrak = $request->no_kontrak;
        $aset->objek_kerjasama = $request->objek_kerjasama;
        $aset->provinsi = $request->provinsi;
        $aset->kabupaten = $request->kabupaten;
        $aset->kecamatan = $request->kecamatan;
        $aset->alamat = $request->alamat;
        $aset->skema_kerjasama = $request->skema_kerjasama;
        $aset->mitra = $request->mitra;
        $aset->bidang_usaha = $request->bidang_usaha;
        $aset->luas_objek = $request->luas_objek;
        $aset->nilai_kontrak = $request->nilai_kontrak;
        $aset->tgl_mulai = $request->tgl_mulai;
        $aset->tgl_berakhir = $request->tgl_berakhir;

        // Update berkas PKS jika ada file yang diupload
        if ($request->hasFile('berkas_pks')) {
            if ($aset->berkas_pks) {
                Storage::delete('public/berkas_pks/' . $aset->berkas_pks);
            }
            $file = $request->file('berkas_pks');
            $aset->berkas_pks = $file->store('public/berkas_pks');
        }

        // Update foto NPWP jika ada file yang diupload
        if ($request->hasFile('foto_npwp')) {
            if ($aset->foto_npwp) {
                Storage::delete('public/foto_npwp/' . $aset->foto_npwp);
            }
            $file = $request->file('foto_npwp');
            $aset->foto_npwp = $file->store('public/foto_npwp');
        }

        // Jika ada file yang diupload, update file lainnya (misalnya foto KTP, dll.)

        // Update data created_by menjadi ID user yang sedang login
        $aset->created_by = Auth::id();

        $aset->save();

        return redirect()->route('aset.index')->with('success', 'Data Aset berhasil diperbarui.');
    }

    public function store(Request $request)
    {
        // Validasi data input
        $validatedData = $request->validate([
            'no_kontrak' => 'required|string|max:255',
            'objek_kerjasama' => 'required|string|max:255',
            'provinsi' => 'required|exists:provinsi,id',
            'kabupaten' => 'required|exists:kota_kabupaten,id',
            'kecamatan' => 'required|exists:kecamatan,id',
            'alamat' => 'required|string|max:255',
            'skema_kerjasama' => 'required|string',
            'mitra' => 'required|string|max:255',
            'bidang_usaha' => 'required|string|max:255',
            'luas_objek' => 'required|numeric',
            'nilai_kontrak' => 'required|numeric',
            'tgl_mulai' => 'required|date',
            'tgl_berakhir' => 'required|date|after_or_equal:tgl_mulai',
            'no_nik' => 'required|string|max:16',
            'no_kk' => 'required|string|max:16',
            'no_npwp' => 'required|string|max:15',
            'tgl_bayar' => 'required|date',
            'file_kmz' => 'nullable|file|mimes:kmz|max:5120', // Maksimal 5MB
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'berkas_shp' => 'nullable|file|mimes:pdf|max:5120', // Maksimal 5MB
            'berkas_pks' => 'nullable|file|mimes:pdf|max:5120', // Maksimal 5MB
            'foto_npwp' => 'required|file|image|max:2048', // Maksimal 2MB
            'foto_ktp' => 'nullable|file|image|max:2048', // Maksimal 2MB
        ]);

        $validatedData['created_by'] = auth()->id();
    
        // Buat instance DataAset baru
        $aset = new DataAset($validatedData);
    
        // Daftar file yang perlu di-upload
        $fileFields = [
            'foto_npwp' => 'uploads/foto_npwp',
            'foto_ktp' => 'uploads/foto_ktp',
            'file_kmz' => 'uploads/kmz',
            'berkas_shp' => 'uploads/shp',
            'berkas_pks' => 'uploads/pks',
        ];
    
        // Proses upload file jika ada
        foreach ($fileFields as $field => $folder) {
            if ($request->hasFile($field)) {
                $aset->$field = $request->file($field)->store($folder, 'public');
            }
        }
    
        // Simpan data ke database
        $aset->save();
    
        // Redirect dengan pesan sukses
        return redirect()
            ->route('aset.create')
            ->with('success', 'Data aset berhasil ditambahkan dengan ID: ' . $aset->id);
    }

    public function destroy($id)
    {
        $aset = DataAset::findOrFail($id);

        // Hapus file terkait jika ada
        if ($aset->berkas_pks) {
            Storage::delete('public/berkas_pks/' . $aset->berkas_pks);
        }
        if ($aset->berkas_shp) {
            Storage::delete('public/berkas_shp/' . $aset->berkas_shp);
        }
        if ($aset->foto_ktp) {
            Storage::delete('public/foto_ktp/' . $aset->foto_ktp);
        }
        if ($aset->foto_npwp) {
            Storage::delete('public/foto_npwp/' . $aset->foto_npwp);
        }

        // Hapus data aset
        $aset->delete();

        return redirect()->route('aset.index')->with('success', 'Data Aset berhasil dihapus.');
    }
    

    public function export()
    {
        $dataAset = DataAset::with('provinsi', 'kabupaten', 'kecamatan')
            ->whereNull('deleted_at')
            ->orderBy('updated_at', 'DESC')
            ->get();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setCellValue('A1', 'Kode Aset')
            ->setCellValue('B1', 'Objek Kerjasama')
            ->setCellValue('C1', 'Provinsi')
            ->setCellValue('D1', 'Kabupaten')
            ->setCellValue('E1', 'Kecamatan')
            ->setCellValue('F1', 'Alamat Lengkap')
            ->setCellValue('G1', 'Nama Mitra')
            ->setCellValue('H1', 'Bidang Usaha Mitra')
            ->setCellValue('I1', 'Luas Objek')
            ->setCellValue('J1', 'Nilai Kontrak')
            ->setCellValue('K1', 'Tanggal Mulai')
            ->setCellValue('L1', 'Tanggal Berakhir')
            ->setCellValue('M1', 'No NIK')
            ->setCellValue('N1', 'No KK')
            ->setCellValue('O1', 'No NPWP')
            ->setCellValue('P1', 'Tanggal Bayar');

        $row = 2;
        foreach ($dataAset as $aset) {
            $sheet->setCellValue('A' . $row, $aset->no_kontrak)
                ->setCellValue('B' . $row, $aset->objek_kerjasama)
                ->setCellValue('C' . $row, $aset->provinsi->nama_provinsi)
                ->setCellValue('D' . $row, $aset->kabupaten->nama)
                ->setCellValue('E' . $row, $aset->kecamatan->nama)
                ->setCellValue('F' . $row, $aset->jalan)
                ->setCellValue('G' . $row, $aset->mitra)
                ->setCellValue('H' . $row, $aset->bidang_usaha)
                ->setCellValue('I' . $row, $aset->luas_objek)
                ->setCellValue('J' . $row, $aset->nilai_kontrak)
                ->setCellValue('K' . $row, $aset->tgl_mulai)
                ->setCellValue('L' . $row, $aset->tgl_berakhir)
                ->setCellValue('M' . $row, $aset->no_nik)
                ->setCellValue('N' . $row, $aset->no_kk)
                ->setCellValue('O' . $row, $aset->no_npwp)
                ->setCellValue('P' . $row, $aset->tgl_bayar);
            $row++;
        }

        $writer = new Xlsx($spreadsheet);
        $filename = 'Data_Aset_' . now()->format('Y-m-d_H-i-s') . '.xlsx';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
        exit;
    }
    public function show($id)
    {
        $aset = DB::table('data_aset')
            ->leftJoin('provinsi', 'data_aset.provinsi', '=', 'provinsi.id')
            ->leftJoin('kota_kabupaten', 'data_aset.kabupaten', '=', 'kota_kabupaten.id')
            ->leftJoin('kecamatan', 'data_aset.kecamatan', '=', 'kecamatan.id')
            ->where('data_aset.id', $id)
            ->select(
                'data_aset.*',
                'provinsi.nama_provinsi',
                'kota_kabupaten.nama',
                'kecamatan.nama as kecamatan_nama'
            )
            ->first();

        if ($aset) {
            return view('aset.show', compact('aset'));
        } else {
            return redirect()->route('aset.index')->with('error', 'Aset tidak ditemukan');
        }
    }
}
