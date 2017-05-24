<?php

namespace App\Http\Controllers\Admin;

use App\Models\Transaksi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TransaksiController extends Controller
{

    public function index()
    {
        $model = Transaksi::orderBy('id','desc')->get();
        return view('admin.transaksi.manage',['model'=>$model]);
    }

    public function show($id)
    {
        $model = Transaksi::findOrFail($id);
        return view('admin.transaksi.detail',['model'=>$model]);
    }

    public function batal($id)
    {
        $model = Transaksi::findOrFail($id);
        $model->status = Transaksi::CANCELED;
        $model->save();

        return redirect()->back();
    }

    public function confirmPayment($id)
    {
        $model = Transaksi::findOrFail($id);
        $model->status = Transaksi::CONFIRMED;
        $model->save();

        return redirect()->back();
    }

    public function cancelPayment($id)
    {
        $model = Transaksi::findOrFail($id);

        $path = base_path('assets/img/pembayaran/');
        if(is_file($path.$model->img_bukti)){
            unlink($path.$model->img_bukti);
        }

        $model->img_bukti = null;
        $model->status = Transaksi::WAITING_PAYMENT;
        $model->save();

        return redirect()->back();
    }

    public function dikirim($id)
    {
        $model = Transaksi::findOrFail($id);
        $model->status = Transaksi::SHIPPED;
        $model->save();

        return redirect()->back();
    }

    public function selesai($id)
    {
        $model = Transaksi::findOrFail($id);
        $model->status = Transaksi::COMPLETE;
        $model->save();

        return redirect()->back();
    }

    public function invoice($id)
    {
        $model = Transaksi::findOrFail($id);
        return view('admin/transaksi/invoice',[
            'model'=>$model
        ]);
    }

}
