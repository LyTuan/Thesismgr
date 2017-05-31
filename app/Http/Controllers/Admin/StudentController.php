<?php

namespace App\Http\Controllers\Admin;

use App\Models\Branch;
use App\Models\Course;
use App\Models\Unit;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;
use Yajra\Datatables\Datatables;

class StudentController extends Controller
{
    public function getIndex() {
        $faculty_id = Auth::user()->faculty_id;
        $courses = Course::all();
        $branches = Branch::where('faculty_id', $faculty_id)->get();
        $faculty_name = Unit::find($faculty_id)->name;
        return view('admin.student', compact('courses', 'branches', 'faculty_name'));
    }

    public function getStudentAdd() {
        return view('admin.students.add');
    }

    public function postStudentAdd(Request $request) {
        $file = $request->input('byFile');
        if($file) {
            // validate
            $this->validate($request, $rules = [
                'file' => 'required|file',
            ]);
            $file = fopen($request->file, "r");
            $mime = mime_content_type($file);
            $excel = [
                'application/vnd.ms-excel',
                'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                'application/octet-stream',
            ];
            fclose($file);
            //action
            if(array_search($mime, $excel)) {
                $input = Input::file('file');
                Student::addStudentByFile($input);
            }
        } else {
            $this->validate($request, $rules = [
                'id' => 'required|unique:students,id',
                'name' => 'required',
                'course' => 'required|numeric',
                'branch' => 'required|numeric',
                'email' => 'required|email',
            ]);
            Student::addStudent($request);
        }
        return redirect()->route('getStudentIndex');
    }

    public function postStudentEdit(Request $request) {
        $this->validate($request, $rules = [
            'id' => 'required',
            'name' => 'required',
            'course' => 'required|numeric',
            'branch' => 'required|numeric',
            'email' => 'required|email',
        ]);
        Student::editStudent($request);
        return redirect()->route('getStudentIndex');
    }

    public function postStudentDelete(Request $request) {
        $this->validate($request, $rules = [
            'id' => 'required',
        ]);
        Student::deleteRecord($request);
        return redirect()->route('getStudentIndex');
    }

    public function apiStudent() {
        $students = DB::table('students')
            ->join('courses', 'students.course_id', '=', 'courses.year')
            ->join('branches', 'students.branch_id', '=', 'branches.id')
            ->join('users', 'students.user_id', '=', 'users.id')
            ->where('branches.faculty_id', Auth::user()->faculty_id)
            ->select('students.*', 'courses.name AS courseName', 'branches.name AS branchName', 'users.email AS email')
            ->get();
        return Datatables::of($students)
            ->addColumn('action', function ($student) {
                return '<button id="edit'.$student->id.'" type="button" class="btn btn-xs btn-primary" onclick="editModal('.$student->id.')">'.
                '<i class="glyphicon glyphicon-edit"></i> Edit'.
                '</button>&nbsp;'.
                '<button id="delete'.$student->id.'" type="button" class="btn btn-xs btn-danger" onclick="deleteModal('.$student->id.')">'.
                '<i class="glyphicon glyphicon-remove"></i> Delete'.
                '</button>';
            })
            ->make(true);
    }
}
