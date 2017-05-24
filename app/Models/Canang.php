<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Canang extends Model
{
    protected $table = 'canang';

    public function canang_detail()
    {
        return $this->hasMany('App\Models\CanangDetail', 'canang_id');
    }

    public function getStatus()
    {
        $status = [1=>'Tersedia',0=>'Tidak Tersedia'];

        return $status[$this->status];
    }

}
