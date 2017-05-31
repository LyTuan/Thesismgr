<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\UserPass;

class Student extends Model
{
    protected $table = 'students';

    protected $fillable = array('id', 'name', 'course_id', 'branch_id', 'status', 'status_register');

    protected $guarded = array('user_id');

    public static function addStudent($request) {
        $faculty_id = Auth::user()->faculty_id;
        $exist = count(self::where('id', $request->id)->get()->toArray());
        if($exist > 0)
            return false;
        $user = new User();
        $user->username = $request->id;
        $password = str_random(10);
        $confirmation_code = str_random(30);
        $user->password = bcrypt($password);
        $user->confirmation_code = $confirmation_code;
        $user->email = $request->email;
        $user->role = '3'; // student
        $user->faculty_id = $faculty_id;
        $user->save();

        $student = new Student;
        $student->id = $request->id;
        $student->name = $request->name;
        $student->course_id = $request->course;
        $student->branch_id = $request->branch;
        $student->user_id = $user->id;
        $student->save();
        Mail::to($user->email)->queue(new UserPass($user->username, $password, $confirmation_code));
    }

    public static function addStudentByFile($file)
    {
        Excel::load($file, function ($reader) {
            $reader->each(function ($sheet) {
                $row = $sheet->toArray();
                if(array_key_exists('ma_sinh_vien', $row)
                    && array_key_exists('ten_sinh_vien', $row)
                    && array_key_exists('email', $row)
                    && array_key_exists('khoa_hoc', $row)
                    && array_key_exists('nganh_hoc', $row)) {
                    $request = [];
                    $request['id'] = $row['ma_sinh_vien'];
                    $request['name'] = $row['ten_sinh_vien'];
                    $request['email'] = $row['email'];
                    $course = DB::table('courses')->select('year')->where(DB::raw('LOWER(name)'), mb_strtolower($row['khoa_hoc'], 'UTF-8'))->first();
                    $branch = DB::table('branches')->select('id')->where(DB::raw('LOWER(name)'), mb_strtolower($row['nganh_hoc'], 'UTF-8'))->first();
                    $request['course'] = $course->year ? $course->year : null;
                    $request['branch'] = $branch->id ? $branch->id : null;
                    self::addStudent((object)$request);
                } else {
                    //
                }
            });
        });
    }

    public static function deleteRecord($request)
    {
        $id = $request->id;
        $student = self::find($id);
        $user = User::find($student->user_id);
        $user->delete();
        $student->delete();
    }

    public static function editStudent($request)
    {
        $id = $request->id;
        $student = self::find($id);
        $student->name = $request->name;
        if(Course::where('year', $request->course)->get())
            $student->course_id = $request->course;
        if(Branch::find($request->branch))
            $student->branch_id = $request->branch;
        $user = User::find($student->user_id);
        if(!User::where('email', $request->email)->get())
            $user->email = $request->email;
        $user->save();
        $student->save();
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
    public function topic(){
    	return $this->hasOne('App\Models\Topic');
    }
}
