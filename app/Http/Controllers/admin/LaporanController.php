<?php

namespace App\Http\Controllers\Admin;

use App\Models\Transaksi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LaporanController extends Controller
{
    public function priod()
    {
        return view('admin/laporan/priod');
    }

    public function result(Request $request)
    {
        $model = Transaksi::whereRaw('created_at>="'.$request->start_date.'"')->whereRaw('created_at<="'.$request->end_date.'"');
        $total_profit = \DB::select('SELECT sum(total) AS total_profit FROM transaksi WHERE status = '.Transaksi::COMPLETE.' AND created_at>="'.$request->start_date.'" AND created_at<="'.$request->end_date.'"');
        $total_transaksi = $model->count();
        $total_success = Transaksi::whereRaw('created_at>="'.$request->start_date.'"')->whereRaw('created_at<="'.$request->end_date.'"')->whereRaw('status = '.Transaksi::COMPLETE)->count();

        $persen = $total_transaksi >0 ? (100/$total_transaksi)*$total_success : 0;
        return view('admin.laporan.result',[
            'model'=>$model->get(),
            'total_profit'=>$total_profit['0']->total_profit,
            'persen'=>$persen,
            'total_transaksi'=>$total_transaksi,
            'periode'=>$request->start_date." - ".$request->end_date
        ]);
    }
}
