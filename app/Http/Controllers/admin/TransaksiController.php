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
        return view('admin.transaksi.cancel_payment',['id'=>$id]);
    }

    public function prosesCancelPayment(Request $request,$id)
    {
        $this->validate($request, [
            'feedback' => 'required',
            'image' => 'required|image|max:3500'
        ]);
        $model = Transaksi::findOrFail($id);
        $path = base_path('assets/img/feedback/');
        $file = \Image::make($request->file('image'))->resize(800, 800)->encode('jpg', 80)->save($path.md5(str_random(12)).'.jpg');

        $model->feedback = $request->feedback;
        $model->img_feedback = $file->basename;
        $model->status = Transaksi::WAITING_PAYMENT;
        $model->save();

        return redirect()->route('admin.transaksi.detail',$id);
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
