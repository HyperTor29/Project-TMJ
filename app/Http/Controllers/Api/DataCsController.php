<?php

namespace App\Http\Controllers\Api;

use Illuminate\Routing\Controller;
use App\Http\Resources\Api\DataCsResource;
use App\Models\DataCs;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class DataCsController extends Controller
{
    public function index()
    {
        $data_cs = DataCs::all();
        return DataCsResource::collection($data_cs);
    }

    public function show($id)
    {
        $data_cs = DataCs::find($id);

        if (!$data_cs) {
            return response()->json(['message' => 'Data not found'], Response::HTTP_NOT_FOUND);
        }

        return new DataCsResource($data_cs);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'nik' => 'required|string|max:16',
            'jabatan' => 'required|string|max:255',
        ]);

        $data_cs = DataCs::create($validatedData);

        return new DataCsResource($data_cs); // Pastikan resource yang digunakan benar
    }

    public function update(Request $request, $id)
    {
        try {
            $data_cs = DataCs::findOrFail($id);

            $validatedData = $request->validate([
                'nama' => 'sometimes|required|string|max:255',
                'nik' => 'sometimes|required|string|max:16',
                'jabatan' => 'sometimes|required|string|max:255',
            ]);

            $data_cs->update($validatedData);

            return new DataCsResource($data_cs);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['message' => 'Data not found'], Response::HTTP_NOT_FOUND);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['message' => 'Validation error', 'errors' => $e->errors()], Response::HTTP_UNPROCESSABLE_ENTITY);
        } catch (\Exception $e) {
            Log::error("Update error for DataCs ID $id: " . $e->getMessage());
            return response()->json(['message' => 'Error updating data'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function destroy($id)
    {
        try {
            $data_cs = DataCs::findOrFail($id);
            $data_cs->delete();
            return response()->json(['message' => 'Data deleted successfully'], Response::HTTP_OK);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['message' => 'Data not found'], Response::HTTP_NOT_FOUND);
        } catch (\Exception $e) {
            Log::error("Delete error for DataCs ID $id: " . $e->getMessage());
            return response()->json(['message' => 'Error deleting data'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
