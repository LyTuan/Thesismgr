<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Mail;
use App\Mail\UserPass;

class Instructor extends Model
{
    protected $table = 'instructors';

    protected $fillable = array('id', 'name', 'unit_id', 'scope_id', 'academic_title', 'degree');

    protected $guarded = array('user_id');

    public static function addInstructor($request) {
        $faculty_id = Auth::user()->faculty_id;

        $exist = count(self::where('id', $request->id)->get()->toArray());
        if($exist > 0)
            return false;
        $user = new User;
        $user->email = $request->email;
        $user->username = substr($request->email, 0, strpos($request->email, '@'));
        $password = str_random(10);
        $confirmation_code = str_random(30);
        $user->confirmation_code = $confirmation_code;
        $user->password = bcrypt($password);
        $user->role = '2';
        $user->faculty_id = $faculty_id;
        $user->save();

        $instructor = new Instructor;
        $instructor->id = $request->id;
        $instructor->name = $request->name;
        $instructor->unit_id = $request->unit;
        $instructor->user_id = $user->id;
        $instructor->save();
        Mail::to($user->email)->queue(new UserPass($user->username, $password, $confirmation_code));
    }

    public static function addInstructorByFile($file)
    {
        Excel::load($file, function ($reader) {
           $reader->each(function ($sheet) {
               $faculty_id = Auth::user()->faculty_id;
               $row = $sheet->toArray();
               if(array_key_exists('ma_giang_vien', $row)
                   && array_key_exists('ten_giang_vien', $row)
                   && array_key_exists('email', $row)
                   && array_key_exists('don_vi', $row)) {
                   $request = [];
                   $request['id'] = $row['ma_giang_vien'];
                   $request['name'] = $row['ten_giang_vien'];
                   $request['email'] = $row['email'];
                   $unit = DB::table('units')
                       ->select('id', 'parent_id')
                       ->where(DB::raw('LOWER(name)'), mb_strtolower($row['don_vi'], 'UTF-8'))
                       ->get();
                   if($unit[0]->parent_id == $faculty_id) {
                       $request['unit'] = $unit[0]->id ? $unit[0]->id : null;
                       self::addInstructor((object)$request);
                   }
               } else {
                    //
               }
           });
        });
    }
    public static function getListInstructor(){
        return Instructor::all();  
    }

    public static function updateInstructor($instructor_id, $request)
    {
        $instructor = self::find($instructor_id);
        if($instructor) {
            $instructor->name = $request->name;
            $instructor->academic_title = $request->academic_title ? $request->academic_title : "";
            $instructor->degree = $request->degree ? $request->degree : "";
            $instructor->research_domain = $request->research_domain ? $request->research_domain : "";

            DB::table('instructor_scope')->where('instructor_id', $instructor_id)->delete();
            foreach ($request->scopes as $scope) {
                $isScope = Scope::find($scope);
                if (is_numeric($scope) && $isScope) {
                    DB::table('instructor_scope')->insert(
                        ['scope_id' => $scope, 'instructor_id' => $instructor_id]
                    );
                }
            }

            $instructor->save();
        }
    }

    public static function editInstructor($request)
    {
        $instructor = self::find($request->id);
        $unit = Unit::find($request->unit);
        if($instructor) {
            $instructor->name = $request->name;
            $instructor->user->email = $request->email;
            $instructor->user->save();
            if($unit && $instructor->user->faculty_id == $unit->parent_id)
                $instructor->unit_id = $request->unit;
            $instructor->save();
        }
    }

    public static function deleteInstructor($request)
    {
        $instructor = Instructor::find($request->id);
        DB::table('users')->where('id', $instructor->user_id)->delete();
        $instructor->delete();
    }


    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function unit()
    {
        return $this->belongsTo('App\Models\Unit');
    }

    public function scopes()
    {
        return $this->belongsToMany('App\Models\Scope');
    }
    public function topic()
    {
        return $this->hasMany('App\Models\Topic');
    }
}
