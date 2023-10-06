<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function index()
    {
        try {
            $posts = User::all();
            return response()->json(['data'=>$posts],200);
        }catch(\Exception $e){
            return response()->json(['error'=>'Something went wrong!'],500);
        }
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required',
                'email' => 'required|string',
                'password' => 'required'
            ]);
            $request->merge(['password'=>md5($request->password)]);
            $post = User::create($request->all());
            return response()->json(['data'=>$post],200);
        }catch(\Exception $e){
            return response()->json(['error'=>$e->getMessage()],500);
        }
    }
}
