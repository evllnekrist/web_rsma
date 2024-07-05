<?php

namespace App\Http\Controllers;
use App\Models\Page;

class PageController extends Controller
{
    public function index($slug)
    {
      $data['selected'] = Page::where('slug',$slug)->first();
      if($data['selected']){
        $data['title'] = $data['selected']->title;
        return view('pages.page', $data);
      }else{
        return view('errors.404');
      }
    }
}
