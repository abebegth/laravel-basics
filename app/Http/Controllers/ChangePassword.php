<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ChangePassword extends Controller
{
    public function changePassword(){
        return view('admin.change_password');
    }
}
