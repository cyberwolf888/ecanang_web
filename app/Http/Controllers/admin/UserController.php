<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    /*
    * Admin
    */
    public function admin()
    {
        $model = User::where('type',1)->orderBy('id','desc')->get();
        return view('admin.user.admin',['model'=>$model]);
    }

    public function create_admin()
    {
        $model = new User();
        return view('admin.user.form_admin',['model'=>$model]);
    }

    public function store_admin(Request $request)
    {
        //dd($request->all());
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'telp' => 'required|alpha_num|max:12',
            'address' => 'required|string|max:255',
            'password' => 'required|string|min:6|confirmed',
            'status' => 'required|alpha_num|max:1',
        ]);

        $model = new User();
        $model->name = $request->name;
        $model->email = $request->email;
        $model->telp = $request->telp;
        $model->address = $request->address;
        $model->password = bcrypt($request->password);
        $model->type = 1;
        $model->status = $request->status;
        $model->save();

        return redirect()->route('admin.user.admin.manage');
    }

    public function edit_admin($id)
    {
        $model = User::findOrFail($id);
        return view('admin.user.form_admin',['model'=>$model,'update'=>true]);
    }

    public function update_admin(Request $request, $id)
    {
        //dd($request->all());
        $model = User::findOrFail($id);
        $validator = [
            'name' => 'required|string|max:255',
            'telp' => 'required|alpha_num|max:12',
            'address' => 'required|string|max:255',
            'status' => 'required|alpha_num|max:1',
        ];

        if($request->email === $model->email){
            $validator['email'] = 'required|string|email|max:255';
        }else{
            $validator['email'] = 'required|string|email|max:255|unique:users';
        }

        if($request->password != null){
            $validator['password'] = 'required|string|min:6|confirmed';
            $model->password = bcrypt($request->password);
        }

        $this->validate($request, $validator);

        $model->name = $request->name;
        $model->email = $request->email;
        $model->telp = $request->telp;
        $model->address = $request->address;
        $model->status = $request->status;
        $model->save();

        return redirect()->route('admin.user.admin.manage');
    }


    /*
     * Member
     */
    public function member()
    {
        $model = User::where('type',2)->orderBy('id','desc')->get();
        return view('admin.user.member',['model'=>$model]);
    }

    public function create_member()
    {
        $model = new User();
        return view('admin.user.form_member',['model'=>$model]);
    }

    public function store_member(Request $request)
    {
        //dd($request->all());
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'telp' => 'required|alpha_num|max:12',
            'address' => 'required|string|max:255',
            'password' => 'required|string|min:6|confirmed',
            'status' => 'required|alpha_num|max:1',
        ]);

        $model = new User();
        $model->name = $request->name;
        $model->email = $request->email;
        $model->telp = $request->telp;
        $model->address = $request->address;
        $model->password = bcrypt($request->password);
        $model->type = 2;
        $model->status = $request->status;
        $model->save();

        return redirect()->route('admin.user.member.manage');
    }

    public function edit_member($id)
    {
        $model = User::findOrFail($id);
        return view('admin.user.form_member',['model'=>$model,'update'=>true]);
    }

    public function update_member(Request $request, $id)
    {
        //dd($request->all());
        $model = User::findOrFail($id);
        $validator = [
            'name' => 'required|string|max:255',
            'telp' => 'required|alpha_num|max:12',
            'address' => 'required|string|max:255',
            'status' => 'required|alpha_num|max:1',
        ];

        if($request->email === $model->email){
            $validator['email'] = 'required|string|email|max:255';
        }else{
            $validator['email'] = 'required|string|email|max:255|unique:users';
        }

        if($request->password != null){
            $validator['password'] = 'required|string|min:6|confirmed';
            $model->password = bcrypt($request->password);
        }

        $this->validate($request, $validator);

        $model->name = $request->name;
        $model->email = $request->email;
        $model->telp = $request->telp;
        $model->address = $request->address;
        $model->status = $request->status;
        $model->save();

        return redirect()->route('admin.user.member.manage');
    }

}
