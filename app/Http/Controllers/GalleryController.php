<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use App\Http\Requests\StoreGalleryRequest;
use App\Http\Requests\UpdateGalleryRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $galleries = Gallery::latest("id")->where('user_id',1)->paginate(30);
        return view('gallery.index',[
            'galleries'=>$galleries
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreGalleryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreGalleryRequest $request)
    {
        //

        foreach($request->file('galleries') as $file){
            $newName = "gallery_".uniqid().".".$file->extension();
            $file->storeAs('public/gallery',$newName);

            $gallery = new Gallery();
            $gallery->post_id = $request->post_id;
            $gallery->photo = $newName;
            $gallery->user_id = Auth::id();
            $gallery->save();
        }


        return  redirect()->to(url()->previous()."#gallery");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function show(Gallery $gallery)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function edit(Gallery $gallery)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateGalleryRequest  $request
     * @param  \App\Models\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateGalleryRequest $request, Gallery $gallery)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function destroy(Gallery $gallery)
    {
        Gate::authorize('delete',$gallery);
        //local file ထဲက ဖျက်တာ
        Storage::delete('public/gallery/'.$gallery->photo);

        //database ထဲက ဖျက်တာ
        $gallery->delete();
        return  redirect()->to(url()->previous()."#gallery");
    }
}
