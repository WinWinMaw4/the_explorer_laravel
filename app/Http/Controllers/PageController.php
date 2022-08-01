<?php

namespace App\Http\Controllers;

use App\Models\ArticleView;
use App\Models\Comment;
use App\Models\Post;
use App\Models\PostView;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PageController extends Controller
{
    //
    public function index(){

        $posts = Post::latest("id")->paginate(5);
        return view("index",["posts"=>$posts]);//compact($posts)
    }

    public function detail($slug){
        $post = Post::where("slug",$slug)->with(['comments','galleries'])->firstOrfail();//firstOrfail က routeကခေါ်ရင်ပါ မရှိရင်ကာတာ

        $viewed = Session::get('viewed_post', []);
        if (!in_array($post->id, $viewed)) {
            $post->increment('views');
            PostView::createViewLog($post);
            Session::push('viewed_post', $post->id);
        }
        return  view('post.detail',["post"=>$post]);
        return $slug;
    }
}
