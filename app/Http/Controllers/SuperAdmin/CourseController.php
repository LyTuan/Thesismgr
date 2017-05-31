<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Models\Course;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;

class CourseController extends Controller
{
    public function getIndex() {
        return view('superadmin.course');
    }

    public function apiCourse() {
        $courses = DB::table('courses')
            ->get();
        return Datatables::of($courses)
            ->addColumn('action', function ($course) {
                return '<button id="edit'.$course->year.'" type="button" class="btn btn-xs btn-primary" onclick="editModal('.$course->year.')">'.
                '<i class="glyphicon glyphicon-edit"></i> Edit'.
                '</button>&nbsp;'.
                '<button id="delete'.$course->year.'" type="button" class="btn btn-xs btn-danger" onclick="deleteModal('.$course->year.')">'.
                '<i class="glyphicon glyphicon-remove"></i> Delete'.
                '</button>';
            })
            ->make(true);
    }

    public function postCourseAdd(Request $request) {
        $this->validate($request, $rules = [
            'year' => 'required|numeric|digits:4',
            'name' => 'required|unique:courses,name',
            'alias' => 'required|unique:courses,alias'
        ]);

        Course::addCourse($request);

        return redirect()->route('superadmin.course');
    }

    public function postCourseEdit(Request $request) {
        $this->validate($request, $rules = [
            'id' => 'required|numeric',
            'name' => 'required',
            'alias' => 'required'
        ]);

        Course::editCourse($request);

        return redirect()->route('superadmin.course');
    }

    public function postCourseDelete(Request $request) {
        $this->validate($request, $rules = [
            'id' => 'required|numeric',
        ]);

        Course::where('year', $request->id)->delete();

        return redirect()->route('superadmin.course');
    }
}
