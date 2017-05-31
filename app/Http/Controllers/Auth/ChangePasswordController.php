<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class ChangePasswordController extends Controller
{
    function getInstructorPasswordChange() {
        return view('all.passwords.change');
    }

    public function postInstructorPasswordChange(Request $request ) {
        $this->validate($request, $rules = [
            'oldpass' => 'required',
            'newpass' => 'required|min:10',
            'repass' => 'required|same:newpass'
        ]);
        if(Hash::check($request->oldpass, Auth::user()->password)) {
            $user = Auth::user();
            $user->password = bcrypt($request->newpass);
            $user->confirmation_code = null;
            $user->save();
        }
        return redirect('admin');
    }
}
