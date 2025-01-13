<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataAset;
use App\Models\Provinsi;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Illuminate\Support\Facades\DB;

class AsetController extends Controller
{
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


    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'no_kontrak' => 'required|string|max:255',
            'objek_kerjasama' => 'required|string|max:255',
            'provinsi' => 'required|exists:provinsi,id',
            'kabupaten' => 'required|exists:kota,id',
            'kecamatan' => 'required|exists:kecamatan,id',
            'jalan' => 'required|string|max:255',
            'skema_kerjasama' => 'required|string',
            'mitra' => 'required|string|max:255',
            'bidang_usaha' => 'required|string|max:255',
            'luas_objek' => 'required|numeric',
            'nilai_kontrak' => 'required|numeric',
            'tgl_mulai' => 'required|date',
            'tgl_berakhir' => 'required|date',
            'no_nik' => 'required|string|max:16',
            'no_kk' => 'required|string|max:16',
            'no_npwp' => 'required|string|max:15',
            'tgl_bayar' => 'required|date',
            'foto_npwp' => 'nullable|image|mimes:jpg,png|max:2048',
            'foto_ktp' => 'nullable|image|mimes:jpg,png|max:2048',
        ]);

        $aset = new DataAset($validatedData);
        if ($request->hasFile('foto_npwp')) {
            $aset->foto_npwp = $request->file('foto_npwp')->store('uploads/foto_npwp', 'public');
        }
        if ($request->hasFile('foto_ktp')) {
            $aset->foto_ktp = $request->file('foto_ktp')->store('uploads/foto_ktp', 'public');
        }
        $aset->save();

        return redirect()->route('aset.create')->with('success', 'Data aset berhasil ditambahkan!');
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
}
