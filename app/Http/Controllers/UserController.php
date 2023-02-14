<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function index(string $user_name) {
        $dbUser = User::where('user_name', $user_name)->first();

        if ($dbUser === null) {
            $message = 'El usuario al que intentas acceder no existe';
            return view('404', compact('message'));
        }

        $toShow = $this->tratarUsuario($dbUser);

        return view('users.user', compact('toShow'));
    }

    private function tratarUsuario($usuario) {
        return [
            'user_name' => $usuario->user_name,
            'profile_photo' => $usuario->profile_photo_path,
            'full_name' => $usuario->name . ' ' . $usuario->surname,
            'followers' => 'To implement',
            'images' => $this->tratarImagenes($usuario->images)
        ];
    }

    private function tratarImagenes($images) {
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

    public function gente() {

        $dbUsers = User::where('id', '!=', auth()->id())
            ->orderByDesc('id')
            ->get();
        $toShow = $this->tratarUsuarios($dbUsers);

        return view('users.users', compact('toShow'));
    }

    private function tratarUsuarios($usuarios) {
        $toShow = [];

        foreach ($usuarios as $usuario) {
            array_push($toShow,[
                'user_name' => $usuario->user_name,
                'profile_photo' => $usuario->profile_photo_path,
                'full_name' => $usuario->name . ' ' . $usuario->surname,
                'followers' => 'To implement'
            ]);
        }

        return($toShow);
    }

    public function search() {

    }
}
