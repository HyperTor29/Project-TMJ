<?php

namespace App\Http\Controllers\Api;

use Illuminate\Routing\Controller;
use App\Http\Resources\Api\TarifResource;
use App\Models\Tarif;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TarifController extends Controller
{
    public function index()
    {
        $tarifs = Tarif::with(['gerbang', 'golkdr'])->get();
        return TarifResource::collection($tarifs);
    }

    public function show($id)
    {
        $tarif = Tarif::with(['gerbang', 'golkdr'])->find($id);

        if (!$tarif) {
            return response()->json(['message' => 'Data not found'], Response::HTTP_NOT_FOUND);
        }

        return new TarifResource($tarif);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'gerbang_id' => 'required|integer|exists:gerbang,id',
            'golkdr_id' => 'required|integer|exists:golkdr,id',
            'tarif' => 'required|integer',
        ]);

        $tarif = Tarif::create($validatedData);

        return new TarifResource($tarif);
    }

    public function update(Request $request, $id)
    {
        $tarif = Tarif::find($id);

        if (!$tarif) {
            return response()->json(['message' => 'Data not found'], Response::HTTP_NOT_FOUND);
        }

        $validatedData = $request->validate([
            'gerbang_id' => 'required|integer|exists:gerbang,id',
            'golkdr_id' => 'required|integer|exists:golkdr,id',
            'tarif' => 'required|integer',
        ]);

        $tarif->update($validatedData);

        return new TarifResource($tarif);
    }

    public function destroy($id)
    {
        $tarif = Tarif::find($id);

        if (!$tarif) {
            return response()->json(['message' => 'Data not found'], Response::HTTP_NOT_FOUND);
        }

        $tarif->delete();

        return response()->json(['message' => 'Data deleted successfully'], Response::HTTP_OK);
    }
}
