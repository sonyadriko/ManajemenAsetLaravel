<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Query untuk total aset yang akan berakhir dalam 1 bulan
        $total_assets = DB::table('data_aset')
            ->whereRaw('tgl_berakhir <= CURDATE() + INTERVAL 30 DAY')
            ->whereNull('deleted_at')
            ->count();

        // Query untuk total aset keseluruhan
        $total_assets_all = DB::table('data_aset')->count();

        // Mengirim data ke view
        return view('dashboard', compact('total_assets', 'total_assets_all'));
    }

    public function storeInvoice(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'nama_mitra' => 'required|string|max:255',
            'alamat_mitra' => 'required|string|max:500',
            'kelurahan' => 'required|string|max:255',
            'kecamatan' => 'required|string|max:255',
            'nama_aset' => 'required|string|max:255',
            'nilai' => 'required|numeric|min:0',
            'ttd' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
        ]);

        // Buat data baru
        $invoice = Invoice::create([
            'no_invoice' => 'INV-' . time(), // Contoh nomor invoice unik
            'no_kontrak' => 'KON-' . time(), // Contoh nomor kontrak
            'nama_mitra' => $validated['nama_mitra'],
            'alamat_mitra' => $validated['alamat_mitra'],
            'kelurahan' => $validated['kelurahan'],
            'kecamatan' => $validated['kecamatan'],
            'nama_aset' => $validated['nama_aset'],
            'nilai_kontrak' => $validated['nilai'],
            'ppn' => $validated['nilai'] * 0.1, // Contoh PPN 10%
            'pph' => $validated['nilai'] * 0.05, // Contoh PPh 5%
            'total' => $validated['nilai'] + ($validated['nilai'] * 0.1) - ($validated['nilai'] * 0.05),
            'jumlah_dibayarkan' => $validated['nilai'], // Bisa disesuaikan
            'ttd' => $validated['ttd'],
            'jabatan' => $validated['jabatan'],
            'created_by' => auth()->id(),
        ]);

        // Redirect dengan pesan sukses
        return redirect()->back()->with('success', 'Invoice berhasil dibuat.');
    }

    public function createInvoice(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'nama_mitra' => 'required|string|max:255',
            'alamat_mitra' => 'required|string|max:500',
            'kelurahan' => 'required|string|max:255',
            'kecamatan' => 'required|string|max:255',
            'nama_aset' => 'required|string|max:255',
            'nilai' => 'required|numeric|min:0',
            'ttd' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
        ]);

        // Perhitungan otomatis
        $ppn = $validated['nilai'] * 0.11;
        $total = $validated['nilai'] + $ppn;
        $pph = $validated['nilai'] * 0.02;
        $jumlah_dibayarkan = $total - $pph;

        // Generate nomor invoice dan kontrak
        $year = date('Y');
        $month = date('m');
        $no_invoice = "INV/{$year}/{$month}/" . sprintf("%04d", rand(1, 9999));
        $no_kontrak = "KTR/{$year}/{$month}/" . sprintf("%04d", rand(1, 9999));

        // Simpan data ke database
        $invoice = Invoice::create([
            'no_invoice' => $no_invoice,
            'no_kontrak' => $no_kontrak,
            'nama_mitra' => $validated['nama_mitra'],
            'alamat_mitra' => $validated['alamat_mitra'],
            'kelurahan' => $validated['kelurahan'],
            'kecamatan' => $validated['kecamatan'],
            'nama_aset' => $validated['nama_aset'],
            'nilai_kontrak' => $validated['nilai'],
            'ppn' => $ppn,
            'pph' => $pph,
            'total' => $total,
            'jumlah_dibayarkan' => $jumlah_dibayarkan,
            'ttd' => $validated['ttd'],
            'jabatan' => $validated['jabatan'],
            'created_by' => auth()->id(),
        ]);

        // Redirect ke halaman cetak dengan data
        return redirect()->route('invoices.print', [
            'nama_mitra' => $invoice->nama_mitra,
            'alamat_mitra' => $invoice->alamat_mitra,
            'kelurahan' => $invoice->kelurahan,
            'kecamatan' => $invoice->kecamatan,
            'nama_aset' => $invoice->nama_aset,
            'nilai' => $invoice->nilai_kontrak,
            'ttd' => $invoice->ttd,
            'no_invoice' => $invoice->no_invoice,
            'no_kontrak' => $invoice->no_kontrak,
            'jabatan' => $invoice->jabatan,
        ]);
    }
    public function printInvoice(Request $request)
    {
        $data = $request->all();

        $ppn = $data['nilai'] * 0.11;
        $total = $data['nilai'] + $ppn;
        $pph = $data['nilai'] * 0.02;
        $jumlah_dibayarkan = $total - $pph;

        $data['ppn'] = $ppn;
        $data['total'] = $total;
        $data['pph'] = $pph;
        $data['jumlah_dibayarkan'] = $jumlah_dibayarkan;
        $data['terbilang'] = self::terbilang($jumlah_dibayarkan);

        $year = date('Y');
        $month = date('m');
        $data['no_invoice'] = "INV/{$year}/{$month}/" . sprintf("%04d", rand(1, 9999));
        $data['no_kontrak'] = "KTR/{$year}/{$month}/" . sprintf("%04d", rand(1, 9999));

        $data['tanggal'] = self::formatTanggalIndonesia(time());

        return view('invoices.print', ['data' => $data]);
    }

    public static function terbilang($number)
    {
        $number = abs($number);
        $words = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
        $result = "";

        if ($number < 12) {
            $result = $words[$number];
        } else if ($number < 20) {
            $result = $words[$number - 10] . " belas";
        } else if ($number < 100) {
            $result = $words[floor($number / 10)] . " puluh " . $words[$number % 10];
        } else if ($number < 200) {
            $result = "seratus " . self::terbilang($number - 100);
        } else if ($number < 1000) {
            $result = $words[floor($number / 100)] . " ratus " . self::terbilang($number % 100);
        } else if ($number < 2000) {
            $result = "seribu " . self::terbilang($number - 1000);
        } else if ($number < 1000000) {
            $result = self::terbilang(floor($number / 1000)) . " ribu " . self::terbilang($number % 1000);
        } else if ($number < 1000000000) {
            $result = self::terbilang(floor($number / 1000000)) . " juta " . self::terbilang($number % 1000000);
        } else if ($number < 1000000000000) {
            $result = self::terbilang(floor($number / 1000000000)) . " milyar " . self::terbilang(fmod($number, 1000000000));
        } else if ($number < 1000000000000000) {
            $result = self::terbilang(floor($number / 1000000000000)) . " triliun " . self::terbilang(fmod($number, 1000000000000));
        }

        return trim($result);
    }

    public static function formatTanggalIndonesia($timestamp)
    {
        $bulanIndonesia = [
            1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
            5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
            9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember',
        ];
        return date('j', $timestamp) . " " . $bulanIndonesia[(int)date('n', $timestamp)] . " " . date('Y', $timestamp);
    }
}
