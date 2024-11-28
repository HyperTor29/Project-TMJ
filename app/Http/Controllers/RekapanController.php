<?php

namespace App\Http\Controllers;

use App\Models\Form;
use App\Models\DetailLolos;
use Illuminate\Http\Request;

class RekapanController extends Controller
{
    public function show($id)
    {
        $record = Form::with('detailLolos')->findOrFail($id);
        return view('filament.resources.rekap-resource.pages.view-rekap', compact('record'));
    }

    public function accept(Request $request, $formId)
    {
        $detailLolosIds = $request->input('detailLolosIds');

        // Menangani setiap detail lolos yang dipilih
        foreach ($detailLolosIds as $detailLolosId) {
            $detailLolos = DetailLolos::findOrFail($detailLolosId);
            // Lakukan aksi "Accept" pada $detailLolos
            $detailLolos->status = 'Accepted';  // Misalnya status diubah menjadi Accepted
            $detailLolos->save();
        }

        return redirect()->route('rekaps.index')->with('success', 'Data telah diterima.');
    }

    public function reject(Request $request, $formId)
    {
        $detailLolosIds = $request->input('detailLolosIds');

        // Menangani setiap detail lolos yang dipilih
        foreach ($detailLolosIds as $detailLolosId) {
            $detailLolos = DetailLolos::findOrFail($detailLolosId);
            // Lakukan aksi "Reject" pada $detailLolos
            $detailLolos->status = 'Rejected';  // Misalnya status diubah menjadi Rejected
            $detailLolos->save();
        }

        return redirect()->route('rekaps.index')->with('success', 'Data telah ditolak.');
    }
}
