<?php

namespace App\Http\Controllers\Student;

use App\Models\Instructor;
use App\Models\Scope;
use App\Models\Unit;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Yajra\Datatables\Datatables;

class ScopeController extends Controller
{
    public function getIndex() {
        $tree = Scope::all()->toHierarchy()->toArray();
        return view('student.scope', compact('tree'));
    }

    public function apiInstructor(Request $request) {
        // create empty collection
        $instructors = collect(new Instructor());
        if($request->scope_id)
            $instructors = Scope::find($request->scope_id)->instructors;
        return Datatables::of($instructors)
            ->addColumn('action', function ($instructor) {
                return '<a type="button" class="btn btn-xs btn-primary" href="'.route('student.instructor.info', ['id' => $instructor->id]).'">'.
                '<i class="glyphicon glyphicon-sunglasses"></i> View'.
                '</a>';
            })
            ->make(true);
    }
}
