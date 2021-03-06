<?php

namespace App\Http\Controllers\Api;

use App\Models\Canang;
use App\Models\Transaksi;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Image;

class TransaksiController extends Controller
{
    public function getTransaksi(Request $request)
    {
        $model = Transaksi::where('user_id',$request->user_id)->with('canang')->orderBy('id','desc')->get();
        $data = [];
        foreach ($model as $row){
            $_return['id'] = $row->id;
            $_return['canang_id'] = $row->canang_id;
            $_return['user_id'] = $row->user_id;
            $_return['telp'] = $row->telp;
            $_return['address'] = $row->address;
            $_return['total'] = $row->total;
            $_return['img_bukti'] = $row->img_bukti;
            $_return['status'] = $row->status;
            $_return['created_at'] = date('d F Y',strtotime($row->created_at));
            $_return['label_status'] = $row->getStatus();
            $_return['nama_paket'] = $row->canang->nama_paket;
            $_return['feedback'] = $row->feedback == '' ? '0':$row->feedback;
            $_return['img_feedback'] = $row->img_feedback == '' ? '0':url('assets/img/feedback/'.$row->img_feedback);
            array_push($data, $_return);
        }

        return response()->json(['status'=>1,'data'=>$data]);

    }

    public function postTransaksi(Request $request)
    {
        $canang = Canang::findOrFail($request->canang_id);
        $model = new Transaksi();
        $model->id = $model->createId();
        $model->canang_id = $request->canang_id;
        $model->user_id = $request->user_id;
        $model->telp = $request->telp;
        $model->address = $request->address;
        $model->total = $canang->harga;
        $model->status = Transaksi::WAITING_PAYMENT;
        $model->save();
    }

    public function postPembayran(Request $request)
    {
        $model = Transaksi::findOrFail($request->transaksi_id);
        $path = base_path('assets/img/pembayaran/');
        if(is_file($path.$model->img_bukti)){
            unlink($path.$model->img_bukti);
        }
        if(is_file($path.$model->img_feedback)){
            unlink($path.$model->img_feedback);
        }
        $file = Image::make($request->file('image_bukti'))->resize(800, 800)->encode('jpg', 80)->save($path.md5(str_random(12)).'.jpg');
        $model->img_bukti = $file->basename;
        $model->img_feedback = '';
        $model->feedback = '';
        $model->status = Transaksi::WAITING_VERIFIED;
        $model->save();
        return response()->json(['status'=>1,'data'=>$model]);
    }
    
    public function cancel(Request $request)
    {
        $model = Transaksi::find($request->transaksi_id);
        $model->status = Transaksi::CANCELED;
        $model->save();
    }
    

}
