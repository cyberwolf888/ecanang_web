<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CanangDetail extends Model
{
    protected $table = 'canang_detail';

    public function canang()
    {
        return $this->belongsTo('App\Models\Canang', 'canang_id');
    }
}
