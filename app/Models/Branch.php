<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    protected $table = "branches";
    public $timestamps = false;

    public static function addBranch($request)
    {
        $branch = new Branch;
        $branch->faculty_id = $request->faculty;
        $branch->name = $request->name;
        $branch->save();
    }

    public static function editBranch($request)
    {
        $branch = Branch::find($request->id);
        if($branch) {
            $faculty = Unit::find($request->faculty);
            if($faculty)
                $branch->faculty_id = $request->faculty;
            $branch->name = $request->name;
            $branch->save();
        }
    }
}
