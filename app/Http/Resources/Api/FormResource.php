<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FormResource extends JsonResource
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
            'tanggal' => $this->tanggal,
            'nama_cs' => $this->whenLoaded('datacs', function () {
                return $this->datacs->nama;
            }),
            'nik_cs' => $this->whenLoaded('datacs', function () {
                return $this->datacs->nik;
            }),
            'jabatan_cs' => $this->whenLoaded('datacs', function () {
                return $this->datacs->jabatan;
            }),
            'nama_css' => $this->whenLoaded('datacss', function () {
                return $this->datacss->nama;
            }),
            'nik_css' => $this->whenLoaded('datacss', function () {
                return $this->datacss->nik;
            }),
            'jabatan_css' => $this->whenLoaded('datacss', function () {
                return $this->datacss->jabatan;
            }),
            'nama_asmen' => $this->whenLoaded('asmen', function () {
                return $this->asmen->nama;
            }),
            'nik_asmen' => $this->whenLoaded('asmen', function () {
                return $this->asmen->nik;
            }),
            'jabatan_asmen' => $this->whenLoaded('asmen', function () {
                return $this->asmen->jabatan;
            }),
        ];
    }
}
