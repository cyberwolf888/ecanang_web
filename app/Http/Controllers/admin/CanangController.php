<?php

namespace App\Http\Controllers\Admin;

use App\Models\Canang;
use App\Models\CanangDetail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Image;

class CanangController extends Controller
{
    public function index()
    {
        $model = Canang::orderBy('id','desc')->get();
        return view('admin.canang.manage',['model'=>$model]);
    }

    public function create()
    {
        $model = new Canang();
        return view('admin.canang.form',['model'=>$model]);
    }

    public function store(Request $request)
    {
        //dd($request->all());
        $this->validate($request, [
            'nama_paket' => 'required',
            'harga' => 'required|max:11|alpha_num',
            'keterangan' => 'required',
            'status' => 'required|max:1|alpha_num',
            'image' => 'required|image|max:3500'
        ]);

        $path = base_path('assets/img/paket/');
        $file = Image::make($request->file('image'))->resize(300, 300)->encode('jpg', 80)->save($path.md5(str_random(12)).'.jpg');

        $model = new Canang();
        $model->nama_paket = $request->nama_paket;
        $model->image = $file->basename;
        $model->harga = $request->harga;
        $model->keterangan = $request->keterangan;
        $model->status = $request->status;
        $model->save();

        $count = count($request->label);

        for ($i=0; $i<$count; $i++){
            $detail = new CanangDetail();
            $detail->canang_id = $model->id;
            $detail->label = $request->label[$i];
            $detail->qty = $request->qty[$i];
            $detail->save();
        }

        return redirect()->route('admin.canang.manage');

    }

    public function show($id)
    {
        $model = Canang::findOrFail($id);
        return view('admin.canang.detail',['model'=>$model]);
    }

    public function edit($id)
    {
        $model = Canang::findOrFail($id);
        return view('admin.canang.form',['model'=>$model,'update'=>true]);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'nama_paket' => 'required',
            'harga' => 'required|max:11|alpha_num',
            'keterangan' => 'required',
            'status' => 'required|max:1|alpha_num',
            'image' => 'image|max:3500'
        ]);

        $model = Canang::findOrFail($id);

        if ($request->hasFile('image')) {
            $path = base_path('assets/img/paket/');
            if(is_file($path.$model->image)){
                unlink($path.$model->image);
            }
            $file = Image::make($request->file('image'))->resize(800, 600)->encode('jpg', 80)->save($path.md5(str_random(12)).'.jpg');
            $model->image = $file->basename;
        }

        $model->nama_paket = $request->nama_paket;
        $model->harga = $request->harga;
        $model->keterangan = $request->keterangan;
        $model->status = $request->status;
        $model->save();

        CanangDetail::where('canang_id', $model->id)->delete();

        $count = count($request->label);

        for ($i=0; $i<$count; $i++){
            $detail = new CanangDetail();
            $detail->canang_id = $model->id;
            $detail->label = $request->label[$i];
            $detail->qty = $request->qty[$i];
            $detail->save();
        }

        return redirect()->route('admin.canang.manage');

    }
}
