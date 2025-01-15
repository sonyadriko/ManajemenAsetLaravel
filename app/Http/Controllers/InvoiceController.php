<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function index()
    {
        $invoice = Invoice::all();
        return view('invoices.index', compact('invoice'));
    }
    public function edit($id)
    {
        $invoice = Invoice::findOrFail($id);
        return view('invoices.edit', compact('invoice'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_mitra' => 'required|string|max:255',
            'alamat_mitra' => 'required|string|max:255',
            'kelurahan' => 'required|string|max:255',
            'kecamatan' => 'required|string|max:255',
            'nama_aset' => 'required|string|max:255',
            'nilai' => 'required|numeric',
            'ttd' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
        ]);

        $invoice = Invoice::findOrFail($id);
        $invoice->update($request->all());

        return redirect()->route('invoices.index')->with('success', 'Invoice berhasil diperbarui.');
    }
    public function destroy($id)
    {
        $invoice = Invoice::findOrFail($id);
        $invoice->delete();

        return redirect()->route('invoices.index')->with('success', 'Invoice berhasil dihapus.');
    }


}
