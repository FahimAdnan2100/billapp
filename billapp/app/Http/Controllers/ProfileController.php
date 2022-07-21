<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function AddProducts(Request $request){


        $data = Profile::insert([
         'name'=>$request->name,
         'age'=>28
        ]);
return response()->json($data);

     }

}
