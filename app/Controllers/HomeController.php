<?php
namespace App\Controllers;

use App\Supports\View;
use App\Supports\Redirect;

class HomeController
{
    public function index()
    {
        View::render('home', [
            'pageTitle' => 'Dashboard',
            'message' => 'Welcome User' 
        ]);
    }

    public function logout()
    {
        unset($_SESSION['user']);
        return Redirect::to('login');
    }
}

