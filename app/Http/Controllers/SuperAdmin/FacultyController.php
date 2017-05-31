<?php

namespace App\Http\Controllers\SuperAdmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\DB;
use App\Models\Unit;

class FacultyController extends Controller
{
    public function getFacultyIndex() {
        return view('superadmin.faculty');
    }

    public function getUnitIndex() {
        $faculties = Unit::where('depth', '0')->get()->toArray();
        return view('superadmin.unit', compact('faculties'));
    }

    //for datatable
    public function apiFaculty() {
        $faculties = DB::table('units')
            ->select('id', 'name')
            ->where('depth', '=', '0')
            ->get();
        return Datatables::of($faculties)
            ->addColumn('action', function ($faculty) {
                return '<button id="edit'.$faculty->id.'" type="button" class="btn btn-xs btn-primary" onclick="editModal('.$faculty->id.')">'.
                            '<i class="glyphicon glyphicon-edit"></i> Edit'.
                       '</button>&nbsp;'.
                '<button id="delete'.$faculty->id.'" type="button" class="btn btn-xs btn-danger" onclick="deleteModal('.$faculty->id.')">'.
                '<i class="glyphicon glyphicon-remove"></i> Delete'.
                '</button>';
            })
            ->make(true);
    }

    // add
    public function postFacultyAdd(Request $request) {
        $this->validate($request, $rules = [
            'faculty' => 'required'
        ]);

        Unit::addFaculty($request->faculty);

        return redirect()->route('getFacultyManage');
    }

    // update
    public function postFacultyEdit(Request $request) {
        $this->validate($request, $rules = [
            'id' => 'required|numeric',
            'faculty' => 'required'
        ]);

        Unit::editFaculty($request);

        return redirect()->route('getFacultyManage');
    }

    //delete
    public function postFacultyDelete(Request $request) {
        $this->validate($request, $rules = [
            'id' => 'required|numeric',
        ]);

        Unit::deleteRecord($request);

        return redirect()->route('getFacultyManage');
    }

    public function apiUnit() {
        $units = DB::table('units AS u1')
            ->join('units AS u2', 'u1.parent_id', '=', 'u2.id')
            ->where('u1.depth', '=', '1')
            ->select('u1.id AS id', 'u1.parent_id', 'u2.name AS facultyName', 'u1.name AS unitName')
            ->get();
        return Datatables::of($units)
            ->addColumn('action', function ($unit) {
                return '<button id="edit'.$unit->id.'" type="button" class="btn btn-xs btn-primary" onclick="editModal('.$unit->parent_id.','.$unit->id.')">'.
                '<i class="glyphicon glyphicon-edit"></i> Edit'.
                '</button>&nbsp;'.
                '<button id="delete'.$unit->id.'" type="button" class="btn btn-xs btn-danger" onclick="deleteModal('.$unit->id.')">'.
                '<i class="glyphicon glyphicon-remove"></i> Delete'.
                '</button>';
            })
            ->make(true);
    }

    public function postUnitAdd(Request $request) {
        $this->validate($request, $rules = [
            'faculty' => 'required|numeric',
            'unit' => 'required'
        ]);

        Unit::addUnit($request);

        //return redirect()->route('getUnitManage');
    }

    // update
    public function postUnitEdit(Request $request) {
        $this->validate($request, $rules = [
            'id' => 'required|numeric',
            'faculty' => 'required|numeric',
            'unit' => 'required'
        ]);

        Unit::editUnit($request);

        return redirect()->route('getFacultyManage');
    }

    //delete
    public function postUnitDelete(Request $request) {
        $this->validate($request, $rules = [
            'id' => 'required|numeric',
        ]);

        Unit::deleteRecord($request);

        return redirect()->route('getUnitManage');
    }
}
