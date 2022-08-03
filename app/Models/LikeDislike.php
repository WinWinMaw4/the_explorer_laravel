<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class LikeDislike extends Model
{
    use HasFactory;

    public function likes(){
            return $this->belongsToMany(Post::class);
        }

    public static function createLikeLog($postId)
        {
            $likes = new LikeDislike();
            $likes->user_id = Auth::id();
            $likes->post_id = $postId;
            $likes->likes = 1;
            $likes->save();
        }
    }
