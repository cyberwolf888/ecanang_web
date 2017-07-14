<?php

namespace App\Http\Controllers\Admin;

use App\Models\Transaksi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $chart = '[';
        /*
        for($i=1; $i<=12; $i++){
            $_profit = \DB::table('transaksi')->select(\DB::Raw('SUM(total) as profit'))->whereRaw("status = ".Transaksi::COMPLETE." AND MONTH(created_at) = ".$i." AND YEAR(created_at) = ".date('Y'))->get()[0]->profit;
            $profit = $_profit == '' ? 0 : $_profit;
            $chart.='['.'"'.strtoupper(date('M', strtotime('01-' . $i . '-2017'))).'",'.$profit.'],';
        }*/
        $transaksi = \DB::select('select t.*,c.nama_paket,count(t.id) as total_transaksi from transaksi AS t inner join canang AS c on c.id = t.canang_id where MONTH(t.created_at) = '.date('m').' group by t.canang_id ');
        foreach ($transaksi as $row){
            $chart.='['.'"'.$row->nama_paket.'",'.$row->total_transaksi.'],';
        }
        $chart = substr($chart, 0, -1).']';

        return view('admin.dashboard.index',[
            'chart'=>$chart
        ]);
    }
}
