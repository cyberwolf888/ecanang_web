<?php

namespace App\Http\Controllers\Api;

use App\Models\Canang;
use App\Models\CanangDetail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CanangController extends Controller
{
    public  function getCanang()
    {
        $model = Canang::where('status',1)->orderBy('id','desc')->get();
        return response()->json(['status'=>1,'data'=>$model->toArray()]);
    }

    public function getCanangDetail(Request $request)
    {
        $model = CanangDetail::where('canang_id',$request->canang_id)->get();
        return response()->json(['status'=>1,'data'=>$model->toArray()]);
    }

    public function getDetailCanang(Request $request)
    {
        $model = Canang::findOrFail($request->canang_id);
        return response()->json(['status'=>1,'data'=>$model->toArray()]);
    }
}
