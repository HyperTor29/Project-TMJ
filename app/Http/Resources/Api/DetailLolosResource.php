<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DetailLolosResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'pukul' => $this->pukul,
            'gardu' => $this->whenLoaded('gardu', function () {
                return $this->gardu->gardu;
            }),
            'nomor_resi_awal' => $this->nomor_resi_awal,
            'nomor_resi_akhir' => $this->nomor_resi_akhir,
            'gerbang' => $this->whenLoaded('gerbang', function () {
                return $this->gerbang->name;
            }),
            'jumlah_kdr' => $this->jumlah_kdr,
            'golongan' => $this->whenLoaded('golkdr', function () {
                return $this->golkdr->golongan;
            }),
            'nomor_kendaraan' => $this->nomor_kendaraan,
            'instansi' => $this->whenLoaded('instansi', function () {
                return $this->instansi->instansi;
            }),
            'penanggung_jawab' => $this->penanggung_jawab,
            'surat_izin_lintas' => $this->surat_izin_lintas,
            'surats' => $this->surats ? array_map(fn($surats) => url($surats['surat']), $this->surats->toArray()) : [],
            'fotos' => $this->fotos ? array_map(fn($detail_fotos) => url($detail_fotos['foto']), $this->fotos->toArray()) : [],
        ];
    }
}
