<?php

namespace App\Http\Controllers;

use App\Models\UrlShortening;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class UrlShortenController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['mailLinkRedirection']);
    }

    public function index()
    {
        $shortUrls= UrlShortening::query()
            ->where('user_id', Auth::user()->id)
            ->get();
        return view('home', compact('shortUrls'));
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'url' => 'required|url'
        ]);
       $shortUrl = new UrlShortening();
       $shortUrl->user_id = Auth::user()->id;
       $shortUrl->url = $request->url;
       $shortUrl->short_code = Str::random(6);
       $shortUrl->click_count = 0;
       $shortUrl->save();
       return redirect()->route('home')->with('success', 'Short URL created successfully.');;
    }

    public function mailLinkRedirection($code){
        $shortUrls = UrlShortening::query()
            ->where('short_code', $code)
            ->first();
        $shortUrls->click_count = $shortUrls['click_count']+1;
        $shortUrls->save();
        return redirect($shortUrls->url);
    }
}
