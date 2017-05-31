<?php

namespace App\Http\Controllers\Student;

use App\Http\Middleware\Instructor;
use App\Models\Unit;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Yajra\Datatables\Datatables;

class UnitController extends Controller
{
    public function getIndex() {
        $faculty_id = Auth::user()->faculty_id;
        $units = Unit::where('parent_id', $faculty_id)->get();
        return view('student.unit', compact('units'));
    }

    public function apiInstructor(Request $request) {
        // create empty collection
        $instructors = collect(new Instructor());
        if($request->unit_id)
            $instructors = Unit::find($request->unit_id)->instructors;
        return Datatables::of($instructors)
            ->addColumn('action', function ($instructor) {
                return '<a type="button" class="btn btn-xs btn-primary" href="'.route('student.instructor.info', ['id' => $instructor->id]).'">'.
                '<i class="glyphicon glyphicon-sunglasses"></i> View'.
                '</a>';
            })
            ->make(true);
    }
}
