<?php

namespace App\Http\Controllers\Api;

use Illuminate\Routing\Controller;
use App\Http\Resources\Api\GerbangResource;
use App\Models\Gerbang;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class GerbangController extends Controller
{
    public function index()
    {
        $gerbangs = Gerbang::all();
        return GerbangResource::collection($gerbangs);
    }

    public function show($id)
    {
        $gerbangs = Gerbang::find($id);

        if (!$gerbangs) {
            return response()->json(['message' => 'Data not found'], Response::HTTP_NOT_FOUND);
        }

        return new GerbangResource($gerbangs);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'kode' => 'required|integer|max:255',
            'name' => 'required|string|max:255',
        ]);

        $gerbangs = Gerbang::create($validatedData);

        return new GerbangResource($gerbangs);
    }

    public function update(Request $request, $id)
    {
        $gerbangs = Gerbang::find($id);

        if (!$gerbangs) {
            return response()->json(['message' => 'Data not found'], Response::HTTP_NOT_FOUND);
        }

        $validatedData = $request->validate([
            'kode' => 'required|integer|max:255',
            'name' => 'required|string|max:255',
        ]);

        $gerbangs->update($validatedData);

        return new GerbangResource($gerbangs);
    }

    public function destroy($id)
    {
        $gerbangs = Gerbang::find($id);

        if (!$gerbangs) {
            return response()->json(['message' => 'Data not found'], Response::HTTP_NOT_FOUND);
        }

        $gerbangs->delete();

        return response()->json(['message' => 'Data deleted successfully'], Response::HTTP_OK);
    }
}
