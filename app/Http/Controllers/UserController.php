<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{

    public function index(string $user_name, bool $isOwner = false) {

        $dbUser = User::where('user_name', $user_name)->first();

        if ($dbUser === null) {
            $message = 'El usuario al que intentas acceder no existe';
            return view('404', compact('message'));
        }

        if ( $isOwner || $user_name === auth()->user()->user_name) {
            $isOwner = true;
        }

        $toShow = $this->tratarUsuario($dbUser);

        return view('users.user', compact('toShow', 'isOwner'));
    }

    public function owner() {
        return $this->index(auth()->user()->user_name, true);
    }

    private function tratarUsuario($usuario) {
        return [
            'user_name' => $usuario->user_name,
            'profile_photo' => $usuario->profile_photo_path,
            'full_name' => $usuario->name . ' ' . $usuario->surname,
            'friends' => $usuario->getFriendsCount(), //implement
            'numOfImages' => count($usuario->images),
            'images' => $this->tratarImagenes($usuario->images),
            'user_id' => $usuario->id,
            'friendRequestPending' => $usuario->hasFriendRequestFrom(auth()->user()),
            'userAndAuthAreFriends' => $usuario->isFriendWith(auth()->user()),
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
            ->paginate(6);

        $toShow = $this->tratarUsuarios($dbUsers);
        $paginator = $dbUsers;
        $elements = $paginator->links()->elements;

        return view('users.users', compact('toShow', 'paginator', 'elements'));
    }

    private function tratarUsuarios($usuarios) {
        $toShow = [];

        foreach ($usuarios as $usuario) {
            array_push($toShow,[
                'user_name' => $usuario->user_name,
                'profile_photo' => $usuario->profile_photo_path,
                'full_name' => $usuario->name . ' ' . $usuario->surname,
            ]);
        }

        return($toShow);
    }

    public function search(Request $req) {

        $validator = Validator::make($req->all(), [
            'query' => 'required'
        ]);

        if ($validator->fails()) {
            $this->gente(); //if query is not provided go back to users view
        }

        $validatedData = $validator->validated();

        $dbUsers = User::where([
            ['id', '!=', auth()->id()],
            [function ($query) use ($validatedData) {
                $query->where('name','like','%'. $validatedData['query'] .'%')
                    ->orWhere('user_name','like','%'. $validatedData['query'] .'%');
            }]
            ])
            ->orderByDesc('id')
            ->paginate(6);

        $toShow = $this->tratarUsuarios($dbUsers);
        $paginator = $dbUsers;
        $elements = $paginator->links()->elements;

        return view('users.users', compact('toShow', 'paginator', 'elements'));

    }
}
