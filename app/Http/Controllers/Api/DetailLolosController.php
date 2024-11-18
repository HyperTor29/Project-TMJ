<?php

namespace App\Http\Controllers\Api;

use Illuminate\Routing\Controller;
use App\Http\Resources\Api\DetailLolosResource;
use App\Models\DetailLolos;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class DetailLolosController extends Controller
{
    public function index()
    {
        try {
            $detail_lolos = DetailLolos::with(['gardu', 'gerbang', 'golkdr', 'instansi', 'surats', 'fotos'])->get();
            return DetailLolosResource::collection($detail_lolos);
        } catch (\Exception $e) {
            Log::error('Error fetching DetailLolos: ' . $e->getMessage());
            return response()->json(['message' => 'Internal Server Error'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function show($id)
    {
        try {
            $detail_lolos = DetailLolos::with(['gardu', 'gerbang', 'golkdr', 'instansi', 'surats', 'fotos'])->find($id);

            if (!$detail_lolos) {
                return response()->json(['message' => 'Data not found'], Response::HTTP_NOT_FOUND);
            }

            return new DetailLolosResource($detail_lolos);
        } catch (\Exception $e) {
            Log::error('Error fetching DetailLolos by ID: ' . $e->getMessage());
            return response()->json(['message' => 'Internal Server Error'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'pukul' => 'required|date_format:H:i',
            'gardu_id' => 'required|integer|exists:gardu,id',
            'nomor_resi_awal' => 'required|string|max:255',
            'nomor_resi_akhir' => 'required|string|max:255',
            'gerbang_id' => 'required|integer|exists:gerbang,id',
            'jumlah_kdr' => 'required|integer',
            'gol_kdr_id' => 'required|integer|exists:gol_kdr,id',
            'nomor_kendaraan' => 'required|string|max:255',
            'instansi_id' => 'required|integer|exists:instansi,id',
            'penanggung_jawab' => 'required|string|max:255',
            'surat_izin_lintas' => 'boolean',
            'surats' => 'array',
            'surats.*' => 'required|file|image',
            'fotos' => 'array',
            'fotos.*' => 'required|file|image',
        ]);

        try {
            $detail_lolos = DetailLolos::create($validatedData);

            if ($request->has('surats')) {
                foreach ($request->file('surats') as $surats) {
                    $path = $surats->store('surats', 'public');
                    $detail_lolos->surats()->create(['surat' => $path]);
                }
            }

            if ($request->has('fotos')) {
                foreach ($request->file('fotos') as $detail_fotos) {
                    $path = $detail_fotos->store('fotos', 'public');
                    $detail_lolos->fotos()->create(['foto' => $path]);
                }
            }

            return new DetailLolosResource($detail_lolos);
        } catch (\Exception $e) {
            Log::error('Error storing DetailLolos: ' . $e->getMessage());
            return response()->json(['message' => 'Internal Server Error'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $detail_lolos = DetailLolos::find($id);

            if (!$detail_lolos) {
                return response()->json(['message' => 'Data not found'], Response::HTTP_NOT_FOUND);
            }

            $validatedData = $request->validate([
                'pukul' => 'required|date_format:H:i',
                'gardu_id' => 'required|integer|exists:gardu,id',
                'nomor_resi_awal' => 'required|string|max:255',
                'nomor_resi_akhir' => 'required|string|max:255',
                'gerbang_id' => 'required|integer|exists:gerbang,id',
                'jumlah_kdr' => 'required|integer',
                'gol_kdr_id' => 'required|integer|exists:gol_kdr,id',
                'nomor_kendaraan' => 'required|string|max:255',
                'instansi_id' => 'required|integer|exists:instansi,id',
                'penanggung_jawab' => 'required|string|max:255',
                'surat_izin_lintas' => 'boolean',
                'surats' => 'array',
                'surats.*' => 'required|file|image',
                'fotos' => 'array',
                'fotos.*' => 'required|file|image',
            ]);

            $detail_lolos->update($validatedData);

            if ($request->has('surats')) {
                foreach ($request->file('surats') as $surats) {
                    $path = $surats->store('surats', 'public');
                    $detail_lolos->surats()->create(['surat' => $path]);
                }
            }

            if ($request->has('fotos')) {
                foreach ($request->file('fotos') as $detail_fotos) {
                    $path = $detail_fotos->store('fotos', 'public');
                    $detail_lolos->fotos()->create(['foto' => $path]);
                }
            }

            return new DetailLolosResource($detail_lolos);
        } catch (\Exception $e) {
            Log::error('Error updating DetailLolos: ' . $e->getMessage());
            return response()->json(['message' => 'Internal Server Error'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function destroy($id)
    {
        try {
            $detail_lolos = DetailLolos::find($id);

            if (!$detail_lolos) {
                return response()->json(['message' => 'Data not found'], Response::HTTP_NOT_FOUND);
            }

            $detail_lolos->delete();

            return response()->json(['message' => 'Data deleted successfully'], Response::HTTP_OK);
        } catch (\Exception $e) {
            Log::error('Error deleting DetailLolos: ' . $e->getMessage());
            return response()->json(['message' => 'Internal Server Error'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
