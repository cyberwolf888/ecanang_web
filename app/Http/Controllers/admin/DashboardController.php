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
        for($i=1; $i<=12; $i++){
            $_profit = \DB::table('transaksi')->select(\DB::Raw('SUM(total) as profit'))->whereRaw("status = ".Transaksi::COMPLETE." AND MONTH(created_at) = ".$i." AND YEAR(created_at) = ".date('Y'))->get()[0]->profit;
            $profit = $_profit == '' ? 0 : $_profit;
            $chart.='['.'"'.strtoupper(date('M', strtotime('01-' . $i . '-2017'))).'",'.$profit.'],';
        }
        $chart = substr($chart, 0, -1).']';

        return view('admin.dashboard.index',[
            'chart'=>$chart
        ]);
    }
}
