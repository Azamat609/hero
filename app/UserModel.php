<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserModel extends Model
{
    public $timestamps = false;
    public $fillable = ['name', 'second_name', 'login', 'password', 'api_token'];
}
