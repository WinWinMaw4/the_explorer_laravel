<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class PostView extends Model
{
    use HasFactory;
    public function postViews(){
        $this->belongsTo(Post::class);
    }
    public static function createViewLog($post) {
        $postViews= new PostView();
        $postViews->post_id = $post->id;
        $postViews->post_slug = Str::slug($post->title);
        $postViews->url = request()->url();
        $postViews->session_id = request()->getSession()->getId();
        $postViews->user_id = (auth()->check())?auth()->id():null;
        $postViews->ip = request()->ip();
        $postViews->agent = request()->header('User-Agent');
        $postViews->save();
    }
}
