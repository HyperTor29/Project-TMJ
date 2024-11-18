<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Gardu extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'gardu',
        'jenis_gardu',
    ];

    public function setNameAttribute($value)
    {
        $this->attributes['jenis_gardu'] = $value;
    }
}
