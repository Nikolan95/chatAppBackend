<?php

namespace App\Http\Controllers;

use App\Models\Picture;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;

class PictureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //return auth()->user();

        if(auth()->user()->picture)
		{
			$picture= auth()->user()->picture;
			$picture->path=$request['file']->storeAs('images/users', $request['file']->getClientOriginalName(), 'public');
			$picture->save();
		}else
		{
			$picture= Picture::create([
                'name' => $request['file']->getClientOriginalName(),
                'path'=>$request['file']->storeAs('images/users', $request['file']->getClientOriginalName(), 'public'),
                'extension'=>'png',
                'user_id'=> auth()->id()
		    ]);
	    }
		return new UserResource($picture->user);
    }

    public function download()
    {
        $picture = Picture::first();

        return response()->download(storage_path('storage/app/public/'.$picture->path));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Picture  $picture
     * @return \Illuminate\Http\Response
     */
    public function show(Picture $picture)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Picture  $picture
     * @return \Illuminate\Http\Response
     */
    public function edit(Picture $picture)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Picture  $picture
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Picture $picture)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Picture  $picture
     * @return \Illuminate\Http\Response
     */
    public function destroy(Picture $picture)
    {
        //
    }
}
