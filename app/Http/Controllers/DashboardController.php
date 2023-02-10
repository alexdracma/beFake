<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index() {
        $images = Image::where('user_id', '!=', auth()->id()) //get only the images that the user didn't post themselves
            ->orderByDesc('id')
            ->get();
        $toShow = $this->treatImages($images);

        return view('dashboard', compact('toShow'));
    }

    private function treatImages($images) {
        $toShow = [];

        foreach ($images as $image) {
            $img = [
                'profilePhoto' => $image->user->profile_photo_path,
                'username' => $image->user->user_name,
                'imgPath' => $image->image_path,
                'description' => $image->description,
                'uploadDateToNow' => Carbon::parse($image->created_at)->locale('es_es')->longRelativeToNowDiffForHumans(Carbon::now()),
                'comments' => count($image->comments),
                'imageId' => $image->id,
                'userLiked' =>  $this->userLiked($image->likes),
                'likes' => count($image->likes),
            ];

            array_push($toShow, $img);
        }

        return $toShow;
    }

    private function userLiked($likes) {
        $currentUser = auth()->id();

        foreach ($likes as $likeId) {
            if ($likeId->user->id === $currentUser) {
                return true;
            }
        }

        return false;
    }
}
