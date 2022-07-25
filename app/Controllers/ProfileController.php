<?php
namespace App\Controllers;

use App\Models\User;
use Twig\TwigFilter;
use Twig\Environment;
use App\Supports\Hash;
use App\Supports\Redirect;
use Twig\Loader\FilesystemLoader;

class ProfileController
{
    public function profile()
    {
        // Check if there's a user logged in
        if (!isset($_SESSION['user'])) {
            return Redirect::to('login');
        }

        // Add filter to the twig environment

        
        $loader = new FilesystemLoader(''. 'views');
        $twig = new Environment($loader);
        $twig->addFilter(new TwigFilter('end_success', function () {
            unset($_SESSION['success']);
        }));
        $twig->addGlobal('session', $_SESSION);

        echo $twig->render('profile.html', [
            'pageTitle'  => 'Edit your account information',
            'user' => $_SESSION['user'],
        ]);
    }

    public function update(array $data = [])
    {
        $user = User::where('username', $data['username'])->first();
        $user->firstname = $data['firstname'];
        $user->lastname = $data['lastname'];
        $user->middlename = $data['middlename'];
        // Check if password has been changed
        if ($data['password'] != '') {
            $user->password = Hash::make($data['password']);
        }
        $user->save();

        $_SESSION['user'] = $user->makeHidden(['password'])->toArray();
        $_SESSION['success'] = 'Account information updated successfully!';
        return Redirect::to('profile');
    }
}

