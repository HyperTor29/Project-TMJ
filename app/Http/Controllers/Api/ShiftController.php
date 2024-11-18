<?php

namespace App\Http\Controllers\Api;

use Illuminate\Routing\Controller;
use App\Http\Resources\Api\ShiftResource;
use App\Models\Shift;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ShiftController extends Controller
{
    public function index()
    {
        $shifts = Shift::all();
        return ShiftResource::collection($shifts);
    }

    public function show($id)
    {
        $shifts = Shift::find($id);

        if (!$shifts) {
            return response()->json(['message' => 'Data not found'], Response::HTTP_NOT_FOUND);
        }

        return new ShiftResource($shifts);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'shift' => 'required|integer|max:255',
            'jam_masuk' => 'required|string|max:255',
            'jam_keluar' => 'required|string|max:255',
        ]);

        $shifts = Shift::create($validatedData);

        return new ShiftResource($shifts);
    }

    public function update(Request $request, $id)
    {
        $shifts = Shift::find($id);

        if (!$shifts) {
            return response()->json(['message' => 'Data not found'], Response::HTTP_NOT_FOUND);
        }

        $validatedData = $request->validate([
            'shift' => 'required|integer|max:255',
            'jam_masuk' => 'required|string|max:255',
            'jam_keluar' => 'required|string|max:255',
        ]);

        $shifts->update($validatedData);

        return new ShiftResource($shifts);
    }

    public function destroy($id)
    {
        $shifts = Shift::find($id);

        if (!$shifts) {
            return response()->json(['message' => 'Data not found'], Response::HTTP_NOT_FOUND);
        }

        $shifts->delete();

        return response()->json(['message' => 'Data deleted successfully'], Response::HTTP_OK);
    }
}
