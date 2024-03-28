<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Link\StoreRequest;
use App\Models\Link;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class LinkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $links = Link::where('user_id', Auth::id())->get();

        $links->transform(function ($link) {
            $link->status = $link->calculateStatus();
            return $link;
        });

        return view('admin.link.index', compact('links'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.link.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = Auth::id();
        $data['expired_at'] = Carbon::now()->addHours(substr($data['expired_at'], 0, 2))
            ->addMinutes(substr($data['expired_at'], 3, 2))
            ->addSeconds(substr($data['expired_at'], 6, 2))
            ->format('Y-m-d H:i:s');

        do {
            $token = Str::random(8);
        } while (Link::where('token', $token)->exists());
        $data['token'] = $token;

        Link::firstOrCreate($data);
        return redirect()->route('admin.link.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Link $link)
    {
        if (Auth::id() != $link->user_id) {
            return redirect()->route('admin.link.index');
        }
        $link->status = $link->calculateStatus();
        return view('admin.link.show', compact('link'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Link $link)
    {
        if (Auth::id() != $link->user_id) {
            return redirect()->route('admin.link.index');
        }
        $date = Carbon::parse($link->expired_at, );

        $currentDateTime = Carbon::now();

        if ($date->gt($currentDateTime)) {
            $differenceInSeconds = $date->diffInSeconds($currentDateTime);
            $expired = gmdate('H:i:s', $differenceInSeconds);
        } else {
            $expired = gmdate('H:i:s', 600);
        }

        return view('admin.link.edit', compact('link', 'expired'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreRequest $request, Link $link)
    {
        $data = $request->validated();
        $data['expired_at'] = Carbon::now()->addHours(substr($data['expired_at'], 0, 2))
            ->addMinutes(substr($data['expired_at'], 3, 2))
            ->addSeconds(substr($data['expired_at'], 6, 2))
            ->format('Y-m-d H:i:s');

        $link->update($data);
        return redirect()->route('admin.link.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Link $link)
    {
        $link->delete();

        return redirect()->route('admin.link.index');
    }
}
