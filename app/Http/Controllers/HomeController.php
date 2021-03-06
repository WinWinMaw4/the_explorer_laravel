<?php

namespace App\Http\Controllers;



use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    //HomeController.php
    public function __construct()
    {
//        $this->middleware(['auth', 'verified']);
                $this->middleware(['auth']);


    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */



    public function index()
    {
        return view('home');
    }

    public function userPost($user_id){

        $posts = Post::latest()->where('user_id',$user_id)->paginate(5);
        return view('post.user-posts',[
            'posts'=>$posts
        ]);
    }

    public function editProfile(){
        return view('profile.edit-profile');
    }

    public function updateProfile(Request $request){

        $request->validate([
            "name" => "required|min:3|max:50",
            "photo" => "nullable|file|mimes:jpeg,png|max:1000",
        ]);

        $user = User::find(auth()->id());
        $user->name = $request->name;
        if($request->hasFile('photo')){

//          delete old photo  => path:storage/profile/profile_6221cecf36ad9.jpg
            $subStrPhotoName = Str::substr($user->photo,16);
            Storage::delete('public/profile/'.$subStrPhotoName);

//            create new photo
            $dir="storage/profile";
            $newName = "profile_".uniqid().".".$request->file('photo')->extension();
            $request->file('photo')->storeAs("public/profile",$newName);
            $user->photo = $dir."/".$newName;
        }
        $user->update();
        return redirect()->back()->with('status','Profile Updated');
    }

    public function changePassword(){
        return view('profile.change-password');
    }

    public function updatePassword(Request $request){
        $request->validate([
            "old_password"=>"required|min:8",
            "password"=>"required|min:8",
            "password_confirmation"=>'required|min:8|same:password',

        ]);

        if(!Hash::check($request->old_password,auth()->user()->password)){
            return redirect()->back()->withErrors(['old_password'=>"password don't match"]);
        }

        $user = User::find(auth()->id());
        $user->password = Hash::make($request->password);
        $user->update();
        auth()->logout();
        return redirect()->route('login');

        return redirect()->back()->with('status','Password Updated');

    }


}
