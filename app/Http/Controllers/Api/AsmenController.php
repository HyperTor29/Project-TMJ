<?php

namespace App\Http\Controllers\Api;

use Illuminate\Routing\Controller;
use App\Http\Resources\Api\AsmenResource;
use App\Models\Asmen;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AsmenController extends Controller
{
    public function index()
    {
        $asmens = Asmen::all();
        return AsmenResource::collection($asmens);
    }

    public function show($id)
    {
        $asmens = Asmen::find($id);

        if (!$asmens) {
            return response()->json(['message' => 'Data not found'], Response::HTTP_NOT_FOUND);
        }

        return new AsmenResource($asmens);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'nik' => 'required|string|max:16',
            'jabatan' => 'required|string|max:255',
        ]);

        $asmens = Asmen::create($validatedData);

        return new AsmenResource($asmens);
    }

    public function update(Request $request, $id)
    {
        $asmens = Asmen::find($id);

        if (!$asmens) {
            return response()->json(['message' => 'Data not found'], Response::HTTP_NOT_FOUND);
        }

        $validatedData = $request->validate([
            'nama' => 'sometimes|required|string|max:255',
            'nik' => 'sometimes|required|string|max:16',
            'jabatan' => 'sometimes|required|string|max:255',
        ]);

        $asmens->update($validatedData);

        return new AsmenResource($asmens);
    }

    public function destroy($id)
    {
        $asmens = Asmen::find($id);

        if (!$asmens) {
            return response()->json(['message' => 'Data not found'], Response::HTTP_NOT_FOUND);
        }

        $asmens->delete();

        return response()->json(['message' => 'Data deleted successfully'], Response::HTTP_OK);
    }
}
