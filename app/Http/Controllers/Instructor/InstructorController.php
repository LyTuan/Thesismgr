<?php

namespace App\Http\Controllers\Instructor;

use App\Models\Instructor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Scope;

class InstructorController extends Controller
{
    public function getInstructorEdit() {
        $page_title = "Thông tin giảng viên";
        $user = Auth::user();
        $instructor = $user->instructor;
        $tree = Scope::all()->toHierarchy()->toArray();
        $scopes = $instructor->scopes;
        return view('instructor.edit', compact('page_title', 'instructor', 'user', 'tree', 'scopes'));
    }

    public function postInstructorEdit(Request $request) {
        $this->validate($request, $rules = [
            'name' => 'required',
        ]);
        $instructor_id = Auth::user()->instructor->id;
        Instructor::updateInstructor($instructor_id, $request);
        return redirect()->route('getInstructorProfile');
    }
}
