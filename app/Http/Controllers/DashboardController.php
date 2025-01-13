<?php

namespace App\Http\Controllers;

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
}
