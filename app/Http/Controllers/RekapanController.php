<?php

namespace App\Http\Controllers;

use App\Models\Form;
use App\Models\DetailLolos;
use Illuminate\Http\Request;
use Filament\Notifications\Notification;
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

        Notification::make()
            ->title('Accept All Success')
            ->success()
            ->body('All details have been accepted successfully.')
            ->send();

        return redirect()->back();
    }

    public function reject(Request $request, $formId)
    {
        $detailLolosIds = $request->input('detailLolosIds', []);

        DetailLolos::whereIn('id', $detailLolosIds)->update(['status' => 'Rejected']);

        Notification::make()
            ->title('Reject All Success')
            ->danger()
            ->body('All details have been rejected successfully.')
            ->send();

        return redirect()->back();
    }

    public function acceptSingle(Request $request, $id, $detailId)
    {
        $detailLolos = DetailLolos::findOrFail($detailId);
        $detailLolos->status = 'Accepted';
        $detailLolos->save();
        Notification::make()
            ->title('Accept Success')
            ->success()
            ->body('The detail has been accepted successfully.')
            ->send();

        return redirect()->back();
    }

    public function rejectSingle(Request $request, $id, $detailId)
    {
        $detailLolos = DetailLolos::findOrFail($detailId);
        $detailLolos->status = 'Rejected';
        $detailLolos->save();
        Notification::make()
            ->title('Reject Success')
            ->danger()
            ->body('The detail has been rejected successfully.')
            ->send();

        return redirect()->back();
    }

    public function print($id)
    {
        $form = Form::findOrFail($id);

        $detailLolos = DetailLolos::where('form_id', $id)->get();

        return view('rekaps.print', compact('form', 'detailLolos'));
    }
}

