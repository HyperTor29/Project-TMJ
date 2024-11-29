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

        $jumlahKendaraan = $record->detailLolos->sum('jumlah_kdr');

        return view('filament.resources.rekap-resource.pages.view-rekap', compact('record', 'jumlahKendaraan'));
    }

    public function accept(Request $request, $formId)
    {
        $detailLolosIds = $request->input('detailLolosIds');

        foreach ($detailLolosIds as $detailLolosId) {
            $detailLolos = DetailLolos::findOrFail($detailLolosId);
            $detailLolos->status = 'Accepted';
            $detailLolos->save();
        }

        return redirect()->route('rekaps.index')->with('success', 'Data telah diterima.');
    }

    public function reject(Request $request, $formId)
    {
        $detailLolosIds = $request->input('detailLolosIds');

        foreach ($detailLolosIds as $detailLolosId) {
            $detailLolos = DetailLolos::findOrFail($detailLolosId);
            $detailLolos->status = 'Rejected';
            $detailLolos->save();
        }

        return redirect()->route('rekaps.index')->with('success', 'Data telah ditolak.');
    }

    public function print($id)
    {
        $form = Form::findOrFail($id);

        $detailLolos = DetailLolos::where('form_id', $id)->get();

        return view('rekaps.print', compact('form', 'detailLolos'));
    }
}
