<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Course extends Model
{
    protected $table = "courses";

    public $timestamps = false;

    public static function addCourse($request)
    {
        $course = new Course;
        $course->year = $request->year;
        $course->name = $request->name;
        $course->alias = $request->alias;
        $course->save();
    }

    public static function editCourse($request)
    {
        $course = DB::table('courses')->where('year', $request->id);
        if($course) {
            $course->update(["name" => $request->name, "alias" => $request->alias]);
        }
    }

    //protected $fillable = [];
}
