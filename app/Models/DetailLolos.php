<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;

class DetailLolos extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'id',
        'pukul',
        'Gardu_id',
        'nomor_resi_awal',
        'nomor_resi_akhir',
        'Gerbang_id',
        'jumlah_kdr',
        'GolKdr_id',
        'nomor_kendaraan',
        'Instansi_id',
        'penanggung_jawab',
        'surat_izin_lintas',
        'surat',
        'foto',
        'user_id',
    ];

    protected $table = 'detail_lolos';

    public function Gardu() {
        return $this->belongsTo(Gardu::class);
    }

    public function Gerbang() {
        return $this->belongsTo(Gerbang::class);
    }

    public function GolKdr() {
        return $this->belongsTo(GolKdr::class);
    }

    public function Instansi() {
        return $this->belongsTo(Instansi::class);
    }

    public function surats(): HasMany
    {
        return $this->hasMany(Surat::class, 'detail_lolos_id');
    }

    public function fotos(): HasMany
    {
        return $this->hasMany(DetailFoto::class, 'detail_lolos_id');
    }

    public function form()
    {
        return $this->belongsTo(Form::class, 'form_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
