<?php
namespace App\Supports;

use DirectoryIterator;

class View extends Directory
{
    public static function render($view, $data = []) :void
    {
        extract($data);
        include_once Directory::BASE_DIR . "/views/$view.php";
    }
}