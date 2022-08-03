<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Post extends Model
{
    use HasFactory;
    protected $with =['user'];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function comments(){
        return $this->hasMany(Comment::class)->latest();
    }

    public function galleries(){
        return $this->hasMany(Gallery::class);
    }

    public function postViews()
    {
        return $this->hasMany(ArticleView::class);
    }

    public function likes(){
        return $this->hasMany(LikeDisLike::class);
    }
    //accessor
    public function getTitleAttribute($value){
        return ucwords($value);
    }

    //mutator
    public function setSlugAttribute($value)
    {
        $this->attributes["slug"] = Str::slug($value);
    }


}
