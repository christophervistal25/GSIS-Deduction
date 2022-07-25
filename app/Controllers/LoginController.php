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
        if (isset($_SESSION['user'])) {
            return Redirect::to('post-deductions');
        }

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
            $_SESSION['errors'] = $validator::$errors;
            return Redirect::to('login');
        }

        $user = User::where('username', $data['username'])->first();
        
        if(Hash::check($data['password'], $user->password)) {
            $_SESSION['user'] = $user->makeHidden(['password'])->toArray();
            return Redirect::to('post-deductions');
        } else {
            $_SESSION['errors'] = ['message' => 'Invalid username or password'];
            return Redirect::to('login');
        }

    }
}

