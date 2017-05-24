<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $table = 'transaksi';
    public $incrementing = false;

    const WAITING_PAYMENT = 1;
    const WAITING_VERIFIED = 2;
    const CONFIRMED = 3;
    const SHIPPED = 4;
    const COMPLETE = 5;
    const CANCELED = 0;

    public function createId()
    {
        $date = date('ym');
        $lastRecord = Transaksi::orderBy('created_at', 'DESC')->first();
        if(count($lastRecord)>0){
            $lastId = substr($lastRecord->id,6)+1;
        }else{
            $lastId = "001";
        }
        $newId = "TR".$date.substr("00000".$lastId,-4);
        return $newId;
    }

    public function getStatus()
    {
        $status = ['Batal','Menunggu Pembayaran','Menunggu Konfirmasi','Sedang Dibuat','Dikirim','Selesai'];
        return $status[$this->status];
    }

    public function canang()
    {
        return $this->belongsTo('App\Models\Canang','canang_id');
    }

    public function user()
    {
        return $this->belongsTo('App\User','user_id');
    }
}
