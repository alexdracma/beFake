<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use App\Models\Image;

class ImageController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function upload() {
        return view('images.upload');
    }

    public function store(Request $request) {

        $validate = $this->validate($request, [
            'imagen'=>'required|mimes:jpg,jpeg,png,gif',
            'descripcion'=>'required'
        ]);

        $image_path = $request->file('imagen');

        if($image_path){
            $image = new Image();
            $image->user_id = auth()->id();
            $image->description = $request->input('descripcion');

            $image_path_name = time().$image_path->getClientOriginalName();
            Storage::disk('images')->put($image_path_name, File::get($image_path) );
            $image->image_path = $image_path_name;
            //dd($image);
            $image->save();
        }
        return redirect()->route('dashboard');
    }
}
