<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Auth;

class IndexController
{
    public function index()
    {
echo'admin.index controller';
//        $user = Auth::user();
//
//        return view('admin.index', compact('user'));
    }
}
