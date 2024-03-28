<?php

namespace App\Http\Controllers;

use App\Models\Link;

use Illuminate\Http\Request;

class RedirectedController extends Controller
{

    public function show(string $token)
    {
        $link = Link::where('token', $token)->firstOrFail();

        if ($link->calculateStatus() != 'active') {
            abort(404);
        }

        $link->incrementViews();
        return redirect($link->original_link);
    }
}
