<?php

namespace App\Http\Controllers;

use App\Models\TempStorage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $images = TempStorage::all();
        return view('home', compact('images'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function uploadImage(Request $request)
    {
        if($request->has('image')) {
            TempStorage::create([
                'image' =>  $request->image->store('upload'),
            ]);
        }

        return redirect()->route('home');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  App\Models\TempStorage $image
     * @return \Illuminate\Http\Response
     */
    public function deleteImage(TempStorage $image)
    {
        if(!empty($image->image) && Storage::exists($image->image)) {
            Storage::delete($image->image);
        }
        $image->delete();

        return redirect()->route('home');
    }
}
