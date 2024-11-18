<?php

namespace App\Http\Controllers\Api;

use Illuminate\Routing\Controller;
use App\Http\Resources\Api\DataCssResource;
use App\Models\DataCss;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class DataCssController extends Controller
{
    public function index()
    {
        $data_css = DataCss::all();
        return DataCssResource::collection($data_css);
    }

    public function show($id)
    {
        $data_css = DataCss::find($id);

        if (!$data_css) {
            return response()->json(['message' => 'Data not found'], Response::HTTP_NOT_FOUND);
        }

        return new DataCssResource($data_css);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'nik' => 'required|string|max:16',
            'jabatan' => 'required|string|max:255',
        ]);

        $data_css = DataCss::create($validatedData);

        return new DataCssResource($data_css);
    }

    public function update(Request $request, $id)
    {
        $data_css = DataCss::find($id);

        if (!$data_css) {
            return response()->json(['message' => 'Data not found'], Response::HTTP_NOT_FOUND);
        }

        $validatedData = $request->validate([
            'nama' => 'sometimes|required|string|max:255',
            'nik' => 'sometimes|required|string|max:16',
            'jabatan' => 'sometimes|required|string|max:255',
        ]);

        $data_css->update($validatedData);

        return new DataCssResource($data_css);
    }

    public function destroy($id)
    {
        $data_css = DataCss::find($id);

        if (!$data_css) {
            return response()->json(['message' => 'Data not found'], Response::HTTP_NOT_FOUND);
        }

        $data_css->delete();

        return response()->json(['message' => 'Data deleted successfully'], Response::HTTP_OK);
    }
}
