<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class FriendsController extends Controller
{
    public function index(User $user) {
        $friends = $user->getFriends($perPage = 6);

        $toShow = $this->tratarUsuarios($friends);
        $paginator = $friends;
        $elements = $paginator->links()->elements;

        return view('friendships.friends', compact('toShow', 'paginator', 'elements'));
    }

    public function store(User $user): void {

        $sender = User::find(auth()->id());

        if (! $sender->isFriendWith($user)) {
            $sender->befriend($user);
        }
    }

    public function destroy(User $user): void {

        $sender = User::find(auth()->id());

        if ($sender->isFriendWith($user)) {
            $sender->unfriend($user);
        }
    }

    public function accept(User $user): void {

        $recipient = User::find(auth()->id());

        $recipient->acceptFriendRequest($user);
    }

    public function deny(User $user): void {

        $recipient = User::find(auth()->id());

        $recipient->denyFriendRequest($user);
    }

    public function show() {

        $peticiones = $this->tratarPeticiones(auth()->user()->getFriendRequests());

        return view('friendships.friendRequests', compact('peticiones'));
    }

    private function tratarPeticiones($peticiones) {
        $toShow = [];

        foreach ($peticiones as $peticion) {
            $sender = User::find($peticion['sender_id']);
            array_push($toShow, [
                'senderUserName' => $sender->user_name,
                'senderName' =>  $sender->name . ' ' . $sender->surname,
                'senderPfp' => $sender->profile_photo_path,
                'senderId' => $sender->id,
            ]);
        }

        return $toShow;
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
}
