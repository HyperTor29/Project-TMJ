<?php

namespace App\Http\Controllers\Api;

use Illuminate\Routing\Controller;
use App\Http\Resources\Api\InstansiResource;
use App\Models\Instansi;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class InstansiController extends Controller
{
    public function index()
    {
        $instansis = Instansi::all();
        return InstansiResource::collection($instansis);
    }

    public function show($id)
    {
        $instansis = Instansi::find($id);

        if (!$instansis) {
            return response()->json(['message' => 'Data not found'], Response::HTTP_NOT_FOUND);
        }

        return new InstansiResource($instansis);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'instansi' => 'required|string|max:255',
        ]);

        $instansis = Instansi::create($validatedData);

        return new InstansiResource($instansis);
    }

    public function update(Request $request, $id)
    {
        $instansis = Instansi::find($id);

        if (!$instansis) {
            return response()->json(['message' => 'Data not found'], Response::HTTP_NOT_FOUND);
        }

        $validatedData = $request->validate([
            'instansi' => 'required|string|max:255',
        ]);

        $instansis->update($validatedData);

        return new InstansiResource($instansis);
    }

    public function destroy($id)
    {
        $instansis = Instansi::find($id);

        if (!$instansis) {
            return response()->json(['message' => 'Data not found'], Response::HTTP_NOT_FOUND);
        }

        $instansis->delete();

        return response()->json(['message' => 'Data deleted successfully'], Response::HTTP_OK);
    }
}
