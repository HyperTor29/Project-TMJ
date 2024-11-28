<?php

namespace App\Http\Controllers;

use App\Models\Form; // Model Form
use App\Models\DetailLolos; // Model DetailLolos
use Illuminate\Http\Request;

class RekapanController extends Controller
{
    // Menampilkan halaman rekapan
    public function show($id)
    {
        // Ambil data Form beserta DetailLolos terkait
        $record = Form::with('detailLolos')->findOrFail($id);

        // Pastikan menggunakan route yang benar untuk print di bagian view
        return view('filament.resources.rekap-resource.pages.view-rekap', compact('record'));
    }

    // Aksi untuk menerima detail lolos (accept)
    public function accept($formId, $detailLolosId)
    {
        $forms = Form::findOrFail($formId);
        $detail_lolos = DetailLolos::findOrFail($detailLolosId);

        // Lakukan aksi penerimaan pada detail
        $detail_lolos->status = 'accepted';
        $detail_lolos->save();

        // Redirect dengan pesan sukses
        return redirect()->route('rekapan.show', $formId)->with('success', 'Detail Lolos diterima');
    }

    // Aksi untuk menolak detail lolos (reject)
    public function reject($formId, $detailLolosId)
    {
        $forms = Form::findOrFail($formId);
        $detail_lolos = DetailLolos::findOrFail($detailLolosId);

        // Lakukan aksi penolakan pada detail
        $detail_lolos->status = 'rejected';
        $detail_lolos->save();

        // Redirect dengan pesan sukses
        return redirect()->route('rekapan.show', $formId)->with('error', 'Detail Lolos ditolak');
    }
}
