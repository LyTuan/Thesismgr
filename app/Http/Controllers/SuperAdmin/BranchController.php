<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Models\Branch;
use App\Models\Course;
use App\Models\Unit;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;

class BranchController extends Controller
{
    public function getIndex() {
        $faculties = Unit::where('depth', 0)->get()->toArray();
        return view('superadmin.branch', compact('faculties'));
    }

    public function apiBranch() {
        $scopes = DB::table('branches')
            ->join('units', 'units.id', '=', 'branches.faculty_id')
            ->select('branches.*', 'units.name AS faculty_name')
            ->get();
        return Datatables::of($scopes)
            ->addColumn('action', function ($scope) {
                return '<button id="edit'.$scope->id.'" type="button" class="btn btn-xs btn-primary" onclick="editModal('.$scope->id.')">'.
                '<i class="glyphicon glyphicon-edit"></i> Edit'.
                '</button>&nbsp;'.
                '<button id="delete'.$scope->id.'" type="button" class="btn btn-xs btn-danger" onclick="deleteModal('.$scope->id    .')">'.
                '<i class="glyphicon glyphicon-remove"></i> Delete'.
                '</button>';
            })
            ->make(true);
    }

    public function postBranchAdd(Request $request) {
        $this->validate($request, $rules = [
            'faculty' => 'required|numeric',
            'name' => 'required|unique:branches,name',
        ]);

        Branch::addBranch($request);

        return redirect()->route('superadmin.branch');
    }

    public function postBranchEdit(Request $request) {
        $this->validate($request, $rules = [
            'id' => 'required|numeric',
            'name' => 'required',
            'faculty' => 'required|numeric'
        ]);

        Branch::editBranch($request);

        return redirect()->route('superadmin.branch');
    }

    public function postBranchDelete(Request $request) {
        $this->validate($request, $rules = [
            'id' => 'required|numeric',
        ]);

        Branch::where('id', $request->id)->delete();

        return redirect()->route('superadmin.branch');
    }
}
