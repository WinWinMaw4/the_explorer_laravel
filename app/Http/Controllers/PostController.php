<?php

namespace App\Http\Controllers;

use App\Classes\FileControl;
use App\Jobs\CreateFile;
use App\Mail\PostMail;
use App\Models\Post;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class PostController extends Controller
{

    public function __construct()
    {
//        $this->middleware(['auth', 'verified'])->except(['index','show']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    //
        return redirect()->route('index');
    }

    public function search(Request $request){
        if ($request->search){
            $searchKey = $request->search;
            $posts = Post::where("title","LIKE","%$searchKey%")->orWhere("description","LIKE","%$searchKey%")->paginate(7)->withQueryString();
            return view('index',compact('posts'));
        }else{
            return redirect()->route('index');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('post.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePostRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePostRequest $request)
    {

//        $newName = "cover_".uniqid().".".$request->file('cover')->extension();
//        $request->file('cover')->storeAs("public/cover",$newName);

        $post = new Post();
        $post->title = $request->title;
        $post->slug = $request->title;//change mutator in post model
        $post->description = $request->description;
//        $post->excerpt = Str::words($request->description,50);
        $post->excerpt = Str::words($request->excerpt,70);
        $newName = FileControl::fileSave('cover','cover');
        $post->cover = $newName;
        $post->user_id = Auth::id();
        $post->save();

//        CreateFile::dispatch($newName)->delay(now()->addSecond(5));


        //Mail send here
        $mailArr = ["mawinwinmaw4@gmail.com","thanthanlwin@gmail.com"];
        foreach ($mailArr as $mail){
            Mail::to($mail)->later(now()->addSecond(60),new PostMail($post->title,$post->excerpt));
        }

        return redirect()->route("index")->with('status','Post Created');

        return $request;
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return redirect()->route('post.detail',$post->slug);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
        Gate::authorize('update',$post);
        return view('post.edit',compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePostRequest  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request, Post $post)
    {


        $post->title = $request->title;
        $post->slug = Str::slug($request->title);
        $post->description = $request->description;
//        $post->excerpt = Str::words($request->description,50);
        $post->excerpt = Str::words($request->excerpt,70);

        if($request->hasFile('cover')){

//            delete old cover
            Storage::delete("public/cover/".$post->cover);

//            upload new cover
//            $newName = "cover_".uniqid()."_".$request->file('cover')->extension();
//            $request->file('cover')->storeAs("public/cover",$newName);

//            save to table
                $post->cover = FileControl::fileSave('cover','cover');
        }

            $post->update();

        return redirect()->route('post.detail',$post->slug)->with('status','Post Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //
        Gate::authorize('delete',$post);

        foreach ($post->galleries as $gallery) {
            Storage::delete('public/gallery/'.$gallery->photo);
        }

        $post->delete();
        return redirect()->route('index');
    }
}
