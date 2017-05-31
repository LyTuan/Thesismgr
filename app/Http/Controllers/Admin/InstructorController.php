<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Unit;
use App\Http\Requests\InstructorAddRequest;
use App\Models\Instructor;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\DB;

class InstructorController extends Controller
{
    public function getIndex() {
        $faculty_id = Auth::user()->faculty_id;
        $faculty = DB::table('units')->where('id', $faculty_id)
            ->select('name')->get();
        $faculty_name = $faculty[0]->name;
        $units = Unit::where('id', $faculty_id)->first()->children()->get();
        return view('admin.instructor', compact('faculty_name', 'units'));
    }

    public function postInstructorAdd(InstructorAddRequest $request) {
        $file = $request->input('byFile');
        if($file) {
            // validate
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
                Instructor::addInstructorByFile($input);
                Session::flash('success', 'Đã thêm thành công giảng viên!');
            }
        } else {
            Instructor::addInstructor($request);
            Session::flash('success', 'Đã thêm thành công giảng viên '.$request->name.'!');
        }
        return redirect()->route('getInstructorIndex');
    }

    public function postInstructorEdit(Request $request) {
        $this->validate($request, $rules = [
            'id' => 'required',
            'unit' => 'required|numeric',
            'email' => 'required|email',
            'name' => 'required'
        ]);

        Instructor::editInstructor($request);

        return redirect()->route('getInstructorIndex');
    }

    public function postInstructorDelete(Request $request) {
        $this->validate($request, $rules = [
            'id' => 'required'
        ]);
        if(Instructor::find($request->id)) {
            Instructor::deleteInstructor($request);
            Session::flash('success', 'Đã xoá thành công giảng viên '.$request->name.'!');
        }
        return redirect()->route('getInstructorIndex');
    }

    public function postIdCheck(Request $request) {
        $this->validate($request, $rules = [
            'id' => 'required',
        ]);
        $instructor = Instructor::where('id', $request->id)->get()->toArray();
        if(count($instructor) > 0)
            return response()->json(["exist" => "true"]);
        else
            return response()->json(["exist" => "false"]);
    }

    public function apiInstructor()
    {
        $instructors = DB::table('instructors')
            ->join('units', 'instructors.unit_id', '=', 'units.id')
            ->join('users', 'instructors.user_id', '=', 'users.id')
            ->where('units.parent_id', Auth::user()->faculty_id)
            ->select('instructors.*', 'units.name AS unitName', 'users.email AS email')
            ->get();
        //$instructors = Instructor::select(['id', 'name', 'unit_id']);
        return Datatables::of($instructors)
            ->addColumn('action', function ($instructor) {
                return '<button id="edit'.$instructor->id.'" type="button" class="btn btn-xs btn-primary" onclick="editModal('.$instructor->unit_id.','.$instructor->id.')">'.
                '<i class="glyphicon glyphicon-edit"></i> Edit'.
                '</button>&nbsp;'.
                '<button id="delete'.$instructor->id.'" type="button" class="btn btn-xs btn-danger" onclick="deleteModal('.$instructor->id.')">'.
                '<i class="glyphicon glyphicon-remove"></i> Delete'.
                '</button>';
            })
            ->make(true);
    }

//    // for ajax
//    public function postUnitByFaculty(Request $request) {
//        $this->validate($request, $rules = [
//            'id' => 'required|numeric',
//        ]);
//        $result = Unit::getUnitByFaculty($request->id);
//        return response()->json($result);
//    }

    public function getInstructorList() {
        $instructors = Instructor::all();
        return view('admin.instructors.list', compact('instructors'));
    }

    public function getInstructorAdd() {
        $page_title = "Thêm giảng viên";
        $faculties = Unit::where('depth', '0')->get()->toArray();
        return view('admin.instructors.add', compact('page_title', 'faculties'));
    }
}
