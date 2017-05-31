<?php

namespace App\Http\Controllers\Student;

use App\Models\Instructor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;

class InstructorController extends Controller
{
     public function getInstructorInfo($id) {
         $instructor = Instructor::find($id);
         return view('instructor.profile', compact('instructor'));
     }

     public function getSearch() {
         return view('student.search');
     }

    /**
     * @return mixed
     */
    public function apiInstructor() {
         $instructors = DB::table('instructors')
             ->join('units', 'instructors.unit_id', '=', 'units.id')
             ->where('units.parent_id', Auth::user()->faculty_id)
             ->select('instructors.*', 'units.name AS unit_name')
             ->get();
         return Datatables::of($instructors)
             ->addColumn('action', function ($instructor) {
                 return '<a type="button" class="btn btn-xs btn-primary" href="'.route('student.instructor.info', ['id' => $instructor->id]).'">'.
                 '<i class="glyphicon glyphicon-sunglasses"></i> View'.
                 '</a>';
             })
             ->make(true);
     }
}
