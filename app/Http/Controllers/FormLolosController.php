<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FormLolos; // Pastikan model FormLolos ada dan sesuai

class FormLolosController extends Controller
{
    /**
     * Tampilkan halaman form lolos/izin lintas.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function print($id)
    {
        $data = FormLolos::with(['DetailLolos'])->findOrFail($id);
        return view('form-lolos', compact('data'));
    }
}
