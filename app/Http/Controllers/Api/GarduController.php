<?php

namespace App\Http\Controllers\Api;

use Illuminate\Routing\Controller;
use App\Http\Resources\Api\GarduResource;
use App\Models\Gardu;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class GarduController extends Controller
{
    public function index()
    {
        $gardus = Gardu::all();
        return GarduResource::collection($gardus);
    }

    public function show($id)
    {
        $gardus = Gardu::find($id);

        if (!$gardus) {
            return response()->json(['message' => 'Data not found'], Response::HTTP_NOT_FOUND);
        }

        return new GarduResource($gardus);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'gardu' => 'required|integer|max:255',
            'jenis_gardu' => 'required|string|max:255',
        ]);

        $gardus = Gardu::create($validatedData);

        return new GarduResource($gardus);
    }

    public function update(Request $request, $id)
    {
        $gardus = Gardu::find($id);

        if (!$gardus) {
            return response()->json(['message' => 'Data not found'], Response::HTTP_NOT_FOUND);
        }

        $validatedData = $request->validate([
            'gardu' => 'required|integer|max:255',
            'jenis_gardu' => 'required|string|max:255',
        ]);

        $gardus->update($validatedData);

        return new GarduResource($gardus);
    }

    public function destroy($id)
    {
        $gardus = Gardu::find($id);

        if (!$gardus) {
            return response()->json(['message' => 'Data not found'], Response::HTTP_NOT_FOUND);
        }

        $gardus->delete();

        return response()->json(['message' => 'Data deleted successfully'], Response::HTTP_OK);
    }
}
