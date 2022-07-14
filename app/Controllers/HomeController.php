<?php
namespace App\Controllers;

use App\Supports\View;

class HomeController
{
    public function index()
    {
        View::render('home', [
            'pageTitle' => 'Dashboard',
            'message' => 'Welcome User' 
        ]);
    }
}

