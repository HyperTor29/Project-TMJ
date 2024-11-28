<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormLolos extends Model
{
    use HasFactory;

    protected $table = 'forms';
    protected $tableDetailLolos = 'detail_lolos';

    public function detailLolos()
    {
        return $this->hasMany(DetailLolos::class, 'form_id', 'id');
    }

    public function form()
    {
        return $this->belongsTo(Form::class, 'form_id', 'id');
    }
}
