<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Auth extends Model
{
    protected $table = 'auths';

    protected $fillable = ['nama','username','password','role'];

    protected $hidden = ['password'];
}
