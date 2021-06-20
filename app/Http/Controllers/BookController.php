<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;

use Illuminate\Http\Request;
use App\Book;

class BookController extends Controller
{
    public function index(){
    	$book = Book::all();
    	return $book;
    }

    public function store(Request $request){
    	$validator = Validator::make($request->all(),[
    		'name'=>'required|min:3|max:255',
    		'content'=>'required',
    		'price'=>'required|min:0|integer|max:900000000',
    		'publisher'=>'required|min:3|max:255',
    		'penname'=>'required|min:1|max:100'
    	],[
    		'name.required'=>'Bạn chưa nhập tên sách',
    		'name.min'=>'Tên quá ngắn',
    		'name.max'=>'Tên quá dài',
    		'content.required'=>'Bạn chưa nhập nội dung',
    		'price.required'=>'Bạn chưa nhập giá bán',
            'price.min'=>'Giá bán không được là số âm',
            'price.integer'=>'Giá bán phải là số nguyên',
    		'price.max'=>'Giá bán quá lơn',
    		'publisher.required'=>'Bạn chưa nhập nhà xuất bản',
    		'publisher.min'=>'Tên nhà xuất bản quá ngắn',
    		'publisher.max'=>'Tên nhà xuất bản quá dài',
    		'penname.required'=>'Bạn chưa nhập bút danh',
    		'penname.min'=>'Bút danh quá ngắn',
    		'penname.max'=>'Bút danh quá dài'
    	]);

    	if($validator->fails()){
    		return response()->json(['errors'=>$validator->messages()]);
    	}
    	$book = new Book();
    	$book->name = $request->name;
    	$book->content = $request->content;
    	$book->price = $request->price;
    	$book->publisher = $request->publisher;
    	$book->penname = $request->penname;
    	$book->save();

    	return response()->json(['success'=>'Book created','id'=>$book->id]);
    }

    public function edit($id){
    	$book = Book::find($id);
    	return $book;
    }

    public function update(Request $request,$id){
    	$validator = Validator::make($request->all(),[
    		'name'=>'required|min:3|max:255',
    		'content'=>'required',
    		'price'=>'required|min:1|numeric',
    		'publisher'=>'required|min:3|max:255',
    		'penname'=>'required|min:1|max:100'
    	],[
    		'name.required'=>'Bạn chưa nhập tên sách',
    		'name.min'=>'Tên quá ngắn',
    		'name.max'=>'Tên quá dài',
    		'content.required'=>'Bạn chưa nhập nội dung',
    		'price.required'=>'Bạn chưa nhập giá bán',
    		'price.min'=>'Giá bán phải lớn hơn 1',
    		'price.numeric'=>'Giá bán phải là kiểu số',
    		'publisher.required'=>'Bạn chưa nhập nhà xuất bản',
    		'publisher.min'=>'Tên nhà xuất bản quá ngắn',
    		'publisher.max'=>'Tên nhà xuất bản quá dài',
    		'penname.required'=>'Bạn chưa nhập bút danh',
    		'penname.min'=>'Bút danh quá ngắn',
    		'penname.max'=>'Bút danh quá dài'
    	]);

    	if($validator->fails()){
    		return response()->json(['errors'=>$validator->messages()]);
    	}

    	$book = Book::find($id);
    	$book->name = $request->name;
    	$book->content = $request->content;
    	$book->price = $request->price;
    	$book->publisher = $request->publisher;
    	$book->penname = $request->penname;
    	$book->save();

    	return response()->json(['success'=>'Book updated']);
    }

    public function delete($id){
    	$book = Book::find($id);
    	if(!$book){
    		return 'Error delete';
    	}
    	
    	$book->delete();
    	return response()->json(['success'=>'Book deleted']);
    }
}
