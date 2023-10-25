<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Tool extends Controller
{
    function hashPassword($password): string
    {
        return password_hash($password,PASSWORD_DEFAULT);
    }
}
