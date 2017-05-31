<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    function getLogin() {
        return view('login');
    }

    public function postLogin(LoginRequest $request ) {
        if (Auth::attempt(['username' => $request->username, 'password' => $request->password], $request->input('remember') ? true : false)) {
            $user = Auth::user();
            if($user->isSuperadmin() )
                return redirect('superadmin');
            else if($user->isAdmin())
                return redirect('admin');
            else if($user->isInstructor())
                return redirect('instructor');
            else
                return redirect('student');
        }
        return view('login');
    }

    public function getLogout () {
        Auth::logout();
        return redirect()->route('getLogin');
    }

    public function activateAccount($code) {
        $user = User::where('confirmation_code', $code)->first();
        if($user) {
            return view('all.active', compact('user'));
        } else {
            echo "forbidden";
        }
    }

    public function postActivateAccount(Request $request) {
        $this->validate($request, $rules = [
            'username' => 'required|exists:users,username',
            'newpass' => 'required',
            'repass' => 'required|same:newpass'
        ]);

        User::editUser($request);

        if (Auth::attempt(['username' => $request->username, 'password' => $request->newpass])) {
            $user = Auth::user();
            if($user->isSuperadmin() )
                return redirect('superadmin');
            else if($user->isAdmin())
                return redirect('admin');
            else if($user->isInstructor())
                return redirect('instructor');
            else
                return redirect('student');
        }
    }
}
