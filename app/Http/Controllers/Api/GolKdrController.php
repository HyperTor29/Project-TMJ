<?php

namespace App\Http\Controllers\Api;

use Illuminate\Routing\Controller;
use App\Http\Resources\Api\GolKdrResource;
use App\Models\GolKdr;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class GolKdrController extends Controller
{
    public function index()
    {
        $gol_kdrs = GolKdr::all();
        return GolKdrResource::collection($gol_kdrs);
    }

    public function show($id)
    {
        $gol_kdrs = GolKdr::find($id);

        if (!$gol_kdrs) {
            return response()->json(['message' => 'Data not found'], Response::HTTP_NOT_FOUND);
        }

        return new GolKdrResource($gol_kdrs);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'golongan' => 'required|integer|max:255',
        ]);

        $gol_kdrs = GolKdr::create($validatedData);

        return new GolKdrResource($gol_kdrs);
    }

    public function update(Request $request, $id)
    {
        $gol_kdrs = GolKdr::find($id);

        if (!$gol_kdrs) {
            return response()->json(['message' => 'Data not found'], Response::HTTP_NOT_FOUND);
        }

        $validatedData = $request->validate([
            'golongan' => 'required|integer|max:255',
        ]);

        $gol_kdrs->update($validatedData);

        return new GolKdrResource($gol_kdrs);
    }

    public function destroy($id)
    {
        $gol_kdrs = GolKdr::find($id);

        if (!$gol_kdrs) {
            return response()->json(['message' => 'Data not found'], Response::HTTP_NOT_FOUND);
        }

        $gol_kdrs->delete();

        return response()->json(['message' => 'Data deleted successfully'], Response::HTTP_OK);
    }
}
