<?php
namespace App\Controllers;

use App\Models\User;
use App\Supports\Hash;
use App\Supports\View;
use App\Service\Container;
use App\Supports\Redirect;
use App\Supports\Validator;
use App\Repositories\UserRepository;

class LoginController
{
    
    public function __construct()
    {
        $this->userRepository = Container::make(UserRepository::class);
    }

    public function index()
    {
        return View::render('login', [
            'message' => 'foobar'
        ]);
    }

    public function login(array $data = [])
    {
        $validator = Validator::make($data, [
            'username' => ['required', 'exists:GSIS_Users,username'],
            'password' => ['required'],
        ]);

        if($validator::fail()) {
            // return Redirect::to('login');
            print_r($validator::$errors);
            return $validator::$errors;
        }

        $user = User::where('username', $data['username'])->first();
        
        if(Hash::check($data['password'], $user->password)) {
            // Set session
            return Redirect::to('home');
        } else {
            print_r($validator::$errors);
        }

    }
}

