<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class User extends Model {
    public $table = 'GSIS_Users';
    public $timestamps = false;
    protected $fillable = ['firstname', 'middlename', 'lastname', 'suffix', 'username', 'password'];
}