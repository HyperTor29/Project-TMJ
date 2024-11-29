<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tarif extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'gerbang_id',
        'gol_kdr_id',
        'tarif',
    ];

    public function Gerbang() {
        return $this->belongsTo(Gerbang::class, 'gerbang_id');
    }

    public function GolKdr() {
        return $this->belongsTo(GolKdr::class, 'gol_kdr_id');
    }
}
