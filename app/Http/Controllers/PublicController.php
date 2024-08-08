<?php

namespace App\Http\Controllers;
use App\Models\Option;

class PublicController extends Controller
{
    public function index()
    {
        $data   = [
            'related_links'     =>Option::where('type','WEB_RELINK')->get(),
            'sliders'           =>Option::where('type','WEB_SLIDER_CONTENT')->get(),
        ];
        return view('index', $data);
    }
}
