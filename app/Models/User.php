<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'username', 'email', 'password', 'role',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token',
    ];

    public static function editUser($request)
    {
        $user = User::where('username', $request->username)->first();
        if($request->newpass == $request->repass) {
            $user->password = bcrypt($request->newpass);
            $user->confirmation_code = null;
            $user->save();
        }
    }

    public function isSuperadmin() {
        return $this->attributes['role'] == 0? true:false;
    }

    public function isAdmin() {
        return $this->attributes['role'] == 1? true:false;
    }

    public function isInstructor() {
        return $this->attributes['role'] == 2? true:false;
    }

    public function isStudent() {
        return $this->attributes['role'] == 3? true:false;
    }

    // relative eloquent
    public function student()
    {
        return $this->hasOne('App\Models\Student');
    }

    public function instructor()
    {
        return $this->hasOne('App\Models\Instructor');
    }

    public static function addAdmin($request) {
        $user = new User;
        $user->email = $request->email ? $request->email : '';
        $user->username = $request->username;
        $user->password = bcrypt($request->username);
        $user->role = '1';
        $user->faculty_id = $request->faculty;
        $user->save();
    }

    public static function deleteAdmin($request)
    {
        DB::table('users')->where('id', $request->id)->delete();
    }

    public static function editAdmin($request)
    {
        $admin = User::find($request->id);
        if($admin) {
            if($admin->role == 1) {
                $admin->email = $request->email;
                if(Unit::find($request->faculty))
                    $admin->faculty_id = $request->faculty;
                $admin->username = $request->username;
                if($request->password && $request->password != '')
                    $admin->password = $request->password;
                $admin->save();
            }
        }
    }
}
