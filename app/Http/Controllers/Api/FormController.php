<?php

namespace App\Http\Controllers\Api;

use Illuminate\Routing\Controller;
use App\Http\Resources\Api\FormResource;
use App\Models\Form;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class FormController extends Controller
{
    public function index()
    {
        $forms = Form::with(['datacs', 'datacss', 'asmen'])->get();
        return FormResource::collection($forms);
    }

    public function show($id)
    {
        $form = Form::with(['datacs', 'datacss', 'asmen'])->find($id);

        if (!$form) {
            return response()->json(['message' => 'Data not found'], Response::HTTP_NOT_FOUND);
        }

        return new FormResource($form);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'tanggal' => 'required|date',
            'datacs_id' => 'required|integer|exists:datacs,id',
            'datacss_id' => 'required|integer|exists:datacss,id',
            'asmen_id' => 'required|integer|exists:asmen,id',
        ]);

        $form = Form::create($validatedData);

        return new FormResource($form);
    }

    public function update(Request $request, $id)
    {
        $form = Form::find($id);

        if (!$form) {
            return response()->json(['message' => 'Data not found'], Response::HTTP_NOT_FOUND);
        }

        $validatedData = $request->validate([
            'tanggal' => 'required|date',
            'datacs_id' => 'required|integer|exists:datacs,id',
            'datacss_id' => 'required|integer|exists:datacss,id',
            'asmen_id' => 'required|integer|exists:asmen,id',
        ]);

        $form->update($validatedData);

        return new FormResource($form);
    }

    public function destroy($id)
    {
        $form = Form::find($id);

        if (!$form) {
            return response()->json(['message' => 'Data not found'], Response::HTTP_NOT_FOUND);
        }

        $form->delete();

        return response()->json(['message' => 'Data deleted successfully'], Response::HTTP_OK);
    }
}
