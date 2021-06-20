<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index(){
    		$users = User::all();
    		return $users;
    }

    public function store(Request $request){
    	$validator = Validator::make($request->all(), [
            'name' => 'required|min:3|max:100',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:3|max:100',
            'repassword' => 'required|same:password'
        ],[
        	'name.required'=>'Bạn chưa nhập tên user',
        	'name.min'=>'Tên user quá ngắn',
        	'name.max'=>'Tên user quá dài',
        	'email.required'=>'Bạn chưa nhập email',
        	'email.email'=>'Email chưa đúng định dạng',
        	'email.unique'=>'Email đã tồn tại',
        	'password.required'=>'Bạn chưa nhập password',
        	'password.min'=>'Password phải lớn hơn 3 ký tự',
        	'password.max'=>'Password quá dài',
        	'repassword.required'=>'Chưa nhận xác nhận password',
        	'repassword.same'=>'Password xác nhận không khớp'
        ]);

    	if($validator->fails()){
    		return response()->json(['errors'=>$validator->messages()]);
    	}

    	$user = new User();
    	$user->name = $request->name;
    	$user->email = $request->email;
    	$user->password = Hash::make($request->password);
    	$user->save();

    	return response()->json(['success'=>'User created','id'=>$user->id]);
    }

    public function edit($id){
    	$user = User::find($id);
    	return $user;
    }

    public function update(Request $request,$id){
    	$validator = Validator::make($request->all(), [
            'name' => 'required|min:3|max:100',
            'email' => 'required|email',
            'password' => 'min:3|max:100',
            'repassword' => 'same:password'
        ],[
        	'name.required'=>'Bạn chưa nhập tên user',
        	'name.min'=>'Tên user quá ngắn',
        	'name.max'=>'Tên user quá dài',
        	'email.required'=>'Bạn chưa nhập email',
        	'email.email'=>'Email chưa đúng định dạng',
        	'password.min'=>'Password phải lớn hơn 3 ký tự',
        	'password.max'=>'Password quá dài',
        	'repassword.same'=>'Password xác nhận không khớp'
        ]);

    	if($validator->fails()){
    		return response()->json(['errors'=>$validator->messages()]);
    	}

    	$user = User::find($id);
    	$user->name = $request->name;
    	$user->email = $request->email;
    	if(!empty($request->password)){
	    	$user->password = Hash::make($request->password);
	    }
    	$user->save();

    	return response()->json(['success'=>'User updated']);
    }

    public function delete($id){
    	$user = User::find($id);
    	$user->delete();
    	return response()->json(['success'=>'User deleted']);
    }
}
