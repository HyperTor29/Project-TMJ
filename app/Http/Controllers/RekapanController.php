<?php

namespace App\Http\Controllers;

use App\Models\Form;
use App\Models\DetailLolos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $detailLolosIds = $request->input('detailLolosIds', []);

        DetailLolos::whereIn('id', $detailLolosIds)->update(['status' => 'Accepted']);

        // Add any additional logic here (e.g., notifications, logging)

        return redirect()->back()->with('success', 'All items have been accepted.');
    }

    public function reject(Request $request, $formId)
    {
        $detailLolosIds = $request->input('detailLolosIds', []);

        DetailLolos::whereIn('id', $detailLolosIds)->update(['status' => 'Rejected']);

        // Add any additional logic here (e.g., notifications, logging)

        return redirect()->back()->with('success', 'All items have been rejected.');
    }

    public function acceptSingle(Request $request, $id, $detailId)
    {
        $detailLolos = DetailLolos::findOrFail($detailId);
        $detailLolos->status = 'Accepted';
        $detailLolos->save();

        return redirect()->back()->with('success', 'All items have been accepted.');
    }

    public function rejectSingle(Request $request, $id, $detailId)
    {
        $detailLolos = DetailLolos::findOrFail($detailId);
        $detailLolos->status = 'Rejected';
        $detailLolos->save();

        return redirect()->back()->with('success', 'All items have been rejected.');
    }

    public function print($id)
    {
        $form = Form::findOrFail($id);

        $detailLolos = DetailLolos::where('form_id', $id)->get();

        return view('rekaps.print', compact('form', 'detailLolos'));
    }
}

