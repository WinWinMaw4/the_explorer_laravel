<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class PageController extends Controller
{
    //
    public function index(){

        $posts = Post::latest("id")->paginate(10);
        return view("index",["posts"=>$posts]);//compact($posts)
    }

    public function detail($slug){
        $post = Post::where("slug",$slug)->with(['comments','galleries'])->firstOrfail();//firstOrfail က routeကခေါ်ရင်ပါ မရှိရင်ကာတာ
        return  view('post.detail',["post"=>$post]);
        return $slug;
    }
}
