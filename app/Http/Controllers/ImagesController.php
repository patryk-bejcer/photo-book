<?php

namespace App\Http\Controllers;

use App\Images;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Symfony\Component\HttpFoundation\File\File;


class ImagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        echo 'index';
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
    	$user = User::findOrFail($id);
        return view('images.create', compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {

        Storage::makeDirectory('public/users/' . Auth::id() . '/images');

	    if($request->file('images')) {

		    foreach ($request->images as $imagee) {

                $image = Image::make($imagee)->encode('jpg', 85)->fit(1200);

                $thumbnail_image_name = pathinfo($imagee->hashName(), PATHINFO_FILENAME).'.'.$imagee->getClientOriginalExtension();
                $image->save(public_path('storage/users/' . Auth::id() . '/images/' . $thumbnail_image_name));

                $image->fit(360,360);
                $thumbnail_image_name = pathinfo($imagee->hashName(), PATHINFO_FILENAME).'.'.$imagee->getClientOriginalExtension();
                $image->save(public_path('storage/users/' . Auth::id() . '/images/thumb-' . $thumbnail_image_name));


                $this->storeToDB($thumbnail_image_name);

		    }

	    }

        Session::flash('message', "Dodawanie zdjęć zakończyło się pomyślnie.");
        return redirect()->route('user-images', ['id' => Auth::id()]);
    }

    public function storeToDB($filename){
        Images::create([
            'user_id' => Auth::id(),
            'path' =>  $filename,
            'visible_level' => 'publish',
            'permission' => 'all',
        ]);
    }

	public function nextImage($user_id, $image_id){

		$user = User::findOrFail($user_id);

		if(!$image = Images::where('id', '>', $image_id)->where('user_id', '=',  $user_id)->first()){

			$image = Images::where('user_id', '=',  $user_id)->first();

		}
		return view('images.single', compact('image', 'user'));
	}

	public function prevImage($user_id, $image_id){

		$user = User::findOrFail($user_id);

		if(!$image = Images::where('id', '<', $image_id)->where('user_id', '=',  $user_id)->first()){

			$image = Images::where('user_id', '=',  $user_id)->first();

		}
		return view('images.single', compact('image', 'user'));
	}



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($user_id, $image_id)
    {
    	$user = User::findOrFail($user_id);
        $image = Images::findOrFail($image_id);
        return view('images.single', compact('image', 'user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
