<?php
namespace App\Services;

use App\Http\Controllers\Controller;
use App\Models\User;

class UserService extends Controller {

    public function checkDuplicateEmail(array $data){
        $user = User::where('email', $data['email']);

        if(isset($data['id'])){
            $user = $user->whereNot('id', $data['id']);
        }

        return $user->exists();
    }

    public function checkDuplicateUsername(array $data){
        $user = User::where('username', $data['username']);

        if(isset($data['id'])){
            $user = $user->whereNot('id', $data['id']);
        }

        return $user->exists();
    }
}