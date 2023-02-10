<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index() {
        $id = auth()->id();
        $dbImgs = Image::where('user_id', $id)->get();

        $toShow = $this->treatImages($dbImgs);
        return view('images.profile', compact('toShow'));
    }

    private function treatImages($images) {
        $toShow = [];

        foreach ($images as $image) {
            $img = [
                'imgPath' => $image->image_path,
                'comments' => count($image->comments),
                'imageId' => $image->id,
                'likes' => count($image->likes),
            ];

            array_push($toShow, $img);
        }

        return $toShow;
    }
}
