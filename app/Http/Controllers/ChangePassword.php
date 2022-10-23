<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use Auth;
use Illuminate\Support\Facades\Hash;


class ChangePassword extends Controller
{
    public function changePassword(){
        return view('admin.change_password');
    }

    public function updatePassword(Request $request){
        $validatedData = $request->validate([
            'oldPassword'=> 'required',
            'password' =>'required',
            'confirmPassword'=>'required'
        ]);

        $oldPass = Auth::user()->password;
        if (Hash::check($request->oldPassword, $oldPass)) {
            $user = User::find(Auth::user()->id);
            $user->password = Hash::make($request->password);
            $user->save();
            Auth::logout();
            return redirect()->route('login')->with('success', 'Password Changed Successfulluy');
        }
        else{
            return redirect()->back()->with('error', 'Something is Wrong, Try Again');
        }

    }
}
