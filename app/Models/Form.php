<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class Form extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'tanggal',
        'Gerbang Tujuan',
        'Shift',
        'Nama CS',
        'NIK CS',
        'Jabatan CS',
        'Nama CSS',
        'NIK CSS',
        'Jabatan CSS',
        'Nama Asmen',
        'NIK Asmen',
        'Jabatan Asmen',
        'Nama Security',
        'Jabatan Security',
        'user_id',
    ];

    protected $table = 'forms';

    public function setNameAttribute($value)
    {
        $this->attributes['Nama'] = $value;
        $this->attributes['Jabatan'] = $value;
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $user = Auth::user();

            if ($user && $user->data_cs) {
                $model->data_cs_id = $user->data_cs->nama;
                $model->data_cs_nik = $user->data_cs->nik;
                $model->data_cs_jabatan = $user->data_cs->jabatan;
            }
        });
    }

    public function GerbangTujuan()
    {
        return $this->belongsTo(GerbangTujuan::class, 'gerbang_tujuan_id');
    }

    public function Shifts()
    {
        return $this->belongsTo(Shift::class, 'shift_id');
    }

    public function DataCs() {
        return $this->belongsTo(DataCs::class, 'data_cs_id');
    }

    public function DataCss() {
        return $this->belongsTo(DataCss::class);
    }

    public function Asmen() {
        return $this->belongsTo(Asmen::class);
    }

    public function DataSecurity() {
        return $this->belongsTo(DataSecurity::class, 'data_securities_id');
    }

    public function detailLolos()
    {
        return $this->hasMany(DetailLolos::class, 'form_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected $dates = ['tanggal'];

    public function setTanggalAttribute($value)
    {
        $this->attributes['tanggal'] = Carbon::createFromFormat('d/m/Y', $value)->format('Y-m-d');
    }
}
