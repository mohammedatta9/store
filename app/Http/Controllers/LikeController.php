<?php

namespace App\Http\Controllers;
use App\Models\Property;
use App\Models\Like;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function like(Request $request)
    {
        $user_id = \auth()->user()->id;
        $property_id = $request->id;
        $data = like::where('user_id', $user_id )->where('property_id', $property_id)->first();
        if ($data) {
            $data->delete();
        }else {
            $like = new Like();
            $like->property_id = $property_id;
            $like->user_id = $user_id;
            $like->like = 1;
            $like->save();

        }
 

        }  

     }
