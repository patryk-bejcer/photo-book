<?php

namespace App\Http\Controllers;

use App\Album;
use App\AlbumsImage;
use App\Images;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class AlbumsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $user = User::findOrFail($id);
        return view('albums.create', compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {



	    if($request->file('primary_image')) {

            Storage::makeDirectory('public/users/' . Auth::id() . '/images');

            $primaryImg = $request->primary_image;

            $image = Image::make($primaryImg)->encode('jpg', 85)->fit(320,320);

            $thumbnail_image_name = pathinfo($primaryImg->hashName(), PATHINFO_FILENAME).'.'.$primaryImg->getClientOriginalExtension();
            $image->save(public_path('storage/users/' . Auth::id() . '/images/' . $thumbnail_image_name));

            $insertAlbum = $this->storePrimaryToDB($thumbnail_image_name, $request);

        }

	    if($request->file('images')) {

		    foreach ( $request->images as $imagee ) {

			    $image = Image::make( $imagee )->encode( 'jpg', 85 );

			    $thumbnail_image_name = pathinfo( $imagee->hashName(), PATHINFO_FILENAME ) . '.' . $imagee->getClientOriginalExtension();
			    $image->save( public_path( 'storage/users/' . Auth::id() . '/images/' . $thumbnail_image_name ) );

			    $image->fit( 360, 360 );
			    $thumbnail_image_name = pathinfo( $imagee->hashName(), PATHINFO_FILENAME ) . '.' . $imagee->getClientOriginalExtension();
			    $image->save( public_path( 'storage/users/' . Auth::id() . '/images/thumb-' . $thumbnail_image_name ) );


			    $insertImage = $this->storeImageToDB( $thumbnail_image_name );

				$this->storeAlbumImageToDB($insertAlbum, $insertImage->id);

		    }
	    }

	    if($request->input('check_image')){

		    $checkedImages = $request->input('check_image');

		    foreach ($checkedImages as $checkImage){
			    $this->storeAlbumImageToDB($insertAlbum, $checkImage);
		    }
	    }

        Session::flash('message', "Dodano nowy album.");
        return redirect()->route('user-albums', ['id' => Auth::id()]);

    }

    public function storePrimaryToDB($filename, Request $request){
        $album = Album::create([
            'user_id' => Auth::id(),
            'title' => $request->name,
            'alt' => '',
            'description' => '',
            'primary_image' =>  $filename,
            'visible_level' => 'publish',
            'permission' => 'all',
        ]);

        return $album;
    }

	public function storeImageToDB($filename){
		$image = Images::create([
			'user_id' => Auth::id(),
			'path' =>  $filename,
			'visible_level' => 'publish',
			'permission' => 'all',
		]);

		return $image;
	}

	public function storeAlbumImageToDB($insertAlbum, $insertImg){
		AlbumsImage::create([
			'album_id' => $insertAlbum->id,
			'image_id' => $insertImg,
		]);
	}



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($user, $album)
    {
    	$user = User::findOrFail($user);
    	$album = Album::findOrFail($album);

        return view('albums.single', compact('album', 'user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
	    $user = User::findOrFail($id);
	    return view('albums.edit', compact('user'));
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
