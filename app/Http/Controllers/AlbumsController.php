<?php

namespace App\Http\Controllers;

use App\Album;
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

            $this->storeToDB($thumbnail_image_name, $request);

        }

        Session::flash('message', "Dodano nowy album.");
        return redirect()->route('user-albums', ['id' => Auth::id()]);

    }

    public function storeToDB($filename, Request $request){
        Album::create([
            'user_id' => Auth::id(),
            'title' => $request->name,
            'alt' => '',
            'description' => '',
            'primary_image' =>  $filename,
            'visible_level' => 'publish',
            'permission' => 'all',
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
