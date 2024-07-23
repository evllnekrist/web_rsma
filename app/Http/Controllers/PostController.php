<?php

namespace App\Http\Controllers;
use App\Models\Post;

class PostController extends Controller
{
    public function show($slug)
    {
      $data['selected'] = Post::where('slug',$slug)->with('created_by_attr')->first();
      if($data['selected']){
        $data['title'] = $data['selected']->title;
        return view('pages.post-detail', $data);
      }else{
        return view('errors.404');
      }
    }
}
