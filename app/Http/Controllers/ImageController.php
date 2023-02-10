<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use App\Models\Image;
use Illuminate\Support\Facades\DB;

class ImageController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function upload() {
        return view('images.upload');
    }

    public function detail(string $id) {
        $dbImg = Image::where('id', $id)->first();
        $image = $this->treatImage($dbImg);

        $authorizedUserId = auth()->id();
        $imgUserId = $dbImg->user->id;

        $isOwner = $authorizedUserId === $imgUserId;
        $userLiked = $this->userLiked($dbImg->likes);

        return view('images.detail', compact('image', 'isOwner', 'userLiked'));
    }

    private function treatImage($image) {
        return [
            'profilePhoto' => $image->user->profile_photo_path,
            'username' => $image->user->user_name,
            'imgPath' => $image->image_path,
            'description' => $image->description,
            'uploadDateToNow' => $this->dateToNow($image->created_at),
            'comments' => $this->treatComments($image->comments),
            'imageId' => $image->id,
            'likes' => count($image->likes),
        ];
    }

    private function treatComments($comments) {
        $toShow = [];
        foreach ($comments as $comment) {
            array_push($toShow, [
                'publisher' => $comment->user->user_name,
                'content' => $comment->content,
                'publishDateToNow' => $this->dateToNow($comment->created_at)
            ]);
        }
        return $toShow;
    }

    private function dateToNow($date) {
        return Carbon::parse($date)->locale('es_es')->longRelativeToNowDiffForHumans(Carbon::now());
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
