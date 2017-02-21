<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use App\User;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function index($id = null){

        $users = DB::table('product')
            ->select('users.avatar','users.name as users_name','products.*')
            ->from('users')
            ->leftjoin('products', function ($join) {
                $join->on('users.id', '=', 'products.user_id');
            })->paginate(7);

        $allproduct = Product::select('*');



        if(\Request::ajax()) {

            return $users;
        }
        return view('home', ['allproduct'=>$allproduct,'users'=>$users,'face_user_id'=>$id,]);
    }
    public function addfruts(Request $request){

        $name = $request['name'];
        $price = $request['price'];
        $user_id = $request['user_id'];
        $file = $request->file('file');


            $this->validate($request,[
                'name'=>'required|max:10',
                'price'=>'required|max:10',
                'image'=>'image|mimes:jpg,png'
            ]);

        $filename = $name.'_'.$user_id.'.jpg';

        if($file){
            Storage::disk('local')->put($filename, File::get($file));
        }
            Product::insert(['name'=>$name,'price'=>$price,'user_id'=>$user_id,'filename'=>$filename]);

        return redirect()->route('/showtable');

    }
    public function delete(Request $request){

        $id = $request['id'];

        $req = Product::where('id',$id)->delete();
        if($req){
            echo 1;
        }else{
            echo 0;
        }

        exit;
//        return redirect()->route('/showtable');
    }

    public function edit(Request $request){

        $id = $request['id'];
        $name = $request['name'];
        $price = $request['price'];
//        dd($id.$name.$price);

        $this->validate($request,[
            'name'=>'required',
            'price'=>'required'
        ]);

        $x = Product::where('id',$id)->update(['name'=>$name,'price'=>$price]);

        $prod = Product::where('id',$id)->first();

        echo json_encode($prod);
        exit;
//        return redirect()->route('/showtable');
    }
    public function file()
    {
        return view('file');
    }


    public function get_userid()
    {
        return (Auth::user()->id);
    }
}


