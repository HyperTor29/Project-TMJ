<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Form extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'tanggal',
        'Nama CS',
        'NIK CS',
        'Jabatan CS',
        'Nama CSS',
        'NIK CSS',
        'Jabatan CSS',
        'Nama Asmen',
        'NIK Asmen',
        'Jabatan Asmen',
        'user_id',

    ];

    public function setNameAttribute($value)
    {
        $this->attributes['Nama'] = $value;
        $this->attributes['Jabatan'] = $value;
    }

    public function DataCs() {
        return $this->belongsTo(DataCs::class);
    }

    public function DataCss() {
        return $this->belongsTo(DataCss::class);
    }

    public function Asmen() {
        return $this->belongsTo(Asmen::class);
    }

    public function detailLolos()
    {
        return $this->hasMany(DetailLolos::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
