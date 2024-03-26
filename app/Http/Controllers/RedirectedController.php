<?php

namespace App\Http\Controllers;

use App\Models\Link;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class RedirectedController extends Controller
{
    public function index(String $token)
    {
         $link = Link::where('token', $token)->firstOrFail();
            $link->status = $link->calculateStatus();
        if($link->status =='active'){
            $link->incrementViews();
            return redirect($link->original_link);
        } else {
            abort(404);
        }
    }
}
