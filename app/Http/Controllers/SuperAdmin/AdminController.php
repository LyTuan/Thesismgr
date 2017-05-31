<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\DB;
use App\Models\Unit;

class AdminController extends Controller
{
    public function getIndex() {
        $faculties = Unit::where('depth', '0')->get()->toArray();
        return view('superadmin.admin', compact('faculties'));
    }

    public function apiAdmin() {
        $users = DB::table('users')
            ->join('units', 'users.faculty_id', '=', 'units.id')
            ->select('users.*', 'units.name AS faculty_name')
            ->where('role', '=', '1')
            ->get();
        return Datatables::of($users)
            ->addColumn('action', function ($user) {
                return '<button id="edit'.$user->id.'" type="button" class="btn btn-xs btn-primary" onclick="editModal('.$user->faculty_id.','.$user->id.')">'.
                '<i class="glyphicon glyphicon-edit"></i> Edit'.
                '</button>&nbsp;'.
                '<button id="delete'.$user->id.'" type="button" class="btn btn-xs btn-danger" onclick="deleteModal('.$user->id.')">'.
                '<i class="glyphicon glyphicon-remove"></i> Delete'.
                '</button>';
            })
            ->make(true);
    }

    public function postAdminAdd(Request $request) {
        $this->validate($request, $rules = [
            'username' => 'required',
            'faculty' => 'required'
        ]);

        User::addAdmin($request);

        return redirect()->route('getAdminManage');
    }

    public function postAdminEdit(Request $request) {
        $this->validate($request, $rules = [
            'id' => 'required|numeric',
            'username' => 'required',
            'faculty' => 'required',
        ]);

        User::editAdmin($request);

        return redirect()->route('getAdminManage');
    }

    public function postAdminDelete(Request $request) {
        $this->validate($request, $rules = [
            'id' => 'required|numeric',
        ]);

        User::deleteAdmin($request);

        return redirect()->route('getAdminManage');
    }
}
