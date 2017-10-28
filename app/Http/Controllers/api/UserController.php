<?php

namespace App\Http\Controllers\Api;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Validator;

class UserController extends Controller
{
    public function login(Request $request)
    {
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password, 'type'=>2, 'status'=>1])){
            $model = Auth::user();
            return response()->json(['status'=>1,'data'=>$model->toArray()]);
        }else{
            return response()->json(['status'=>0]);
        }
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'telp' => 'required|alpha_num|max:12',
            'address' => 'required|string|max:255',
            'password' => 'required|string|min:6|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json(['status'=>0,'error'=>'Data tidak valid.']);
        }

        $model = new User();
        $model->name = $request->name;
        $model->email = $request->email;
        $model->telp = $request->telp;
        $model->address = $request->address;
        $model->password = bcrypt($request->password);
        $model->type = 2;
        $model->status = 1;
        $model->save();

        return response()->json(['status'=>1,'data'=>$model->toArray()]);
    }

    public function edit_account(Request $request)
    {
        $model = User::find($request->id);
        return response()->json(['status'=>1,'data'=>$model->toArray()]);
    }

    public function update_account(Request $request)
    {
        $model = User::find($request->id);
        $rules = [
            'name' => 'required|string|max:255',
            'telp' => 'required|alpha_num|max:12',
            'address' => 'required|string|max:255',
        ];

        if($request->email === $model->email){
            $rules['email'] = 'required|string|email|max:255';
        }else{
            $rules['email'] = 'required|string|email|max:255|unique:users';
        }

        if($request->password != null){
            $rules['password'] = 'required|string|min:6|confirmed';
            $model->password = bcrypt($request->password);
        }

        $validator = Validator::make($request->all(),$rules);
        if ($validator->fails()) {
            return response()->json(['status'=>0,'error'=>'Data tidak valid.']);
        }

        $model->name = $request->name;
        $model->email = $request->email;
        $model->telp = $request->telp;
        $model->address = $request->address;
        $model->status = $request->status;
        $model->save();

        return response()->json(['status'=>1]);
    }
}
