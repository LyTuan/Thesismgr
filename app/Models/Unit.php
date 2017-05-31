<?php

namespace App\Models;

use Baum\Node;
use Illuminate\Support\Facades\DB;

/**
 * Unit
 */
class Unit extends Node
{

    /**
     * Table name.
     *
     * @var string
     */
    protected $table = 'units';
    public $timestamps = false;

    //////////////////////////////////////////////////////////////////////////////

    //
    // Below come the default values for Baum's own Nested Set implementation
    // column names.
    //
    // You may uncomment and modify the following fields at your own will, provided
    // they match *exactly* those provided in the migration.
    //
    // If you don't plan on modifying any of these you can safely remove them.
    //

    // /**
    //  * Column name which stores reference to parent's node.
    //  *
    //  * @var string
    //  */
    protected $parentColumn = 'parent_id';

    // /**
    //  * Column name for the left index.
    //  *
    //  * @var string
    //  */
    protected $leftColumn = 'lft';

    // /**
    //  * Column name for the right index.
    //  *
    //  * @var string
    //  */
    protected $rightColumn = 'rgt';

    // /**
    //  * Column name for the depth field.
    //  *
    //  * @var string
    //  */
    protected $depthColumn = 'depth';
    protected $name = 'name';

    // /**
    //  * Column to perform the default sorting
    //  *
    //  * @var string
    //  */
    //protected $orderColumn = null;

    // /**
    // * With Baum, all NestedSet-related fields are guarded from mass-assignment
    // * by default.
    // *
    // * @var array
    // */
    protected $guarded = array('id', 'parent_id', 'lft', 'rgt', 'depth');
    protected $fillable = array('name');

    //
    // This is to support "scoping" which may allow to have multiple nested
    // set trees in the same database table.
    //
    // You should provide here the column names which should restrict Nested
    // Set queries. f.ex: company_id, etc.
    //

    // /**
    //  * Columns which restrict what we consider our Nested Set list
    //  *
    //  * @var array
    //  */
    //protected $scoped = array();

    // my code
    public static function getUnitByFaculty($id) {
        $units = Unit::where('id', $id)->first()->children()->get();
        $result = [];
        foreach ($units as $unit) {
            $json = json_decode((string)$unit); // (string)$unit is json format
            $tmp = [];
            $tmp['id'] = $json->id;
            $tmp['name'] = $json->name;
            array_push($result, $tmp);
        }
        return $result;
    }

    public static function addFaculty($faculty)
    {
        $root = self::create(['name' => $faculty]);
        $root->makeRoot();
    }

    public static function editFaculty($request)
    {
        DB::table('units')
            ->where('id', $request->id)
            ->update(['name' => $request->faculty]);
    }

    public static function addUnit($request)
    {
        $parent = Unit::find($request->faculty);
        $child = $parent->children()->create(['name' => $request->unit]);
    }

    public static function editUnit($request)
    {
        // update name
        DB::table('units')
            ->where('id', $request->id)
            ->update(['name' => $request->unit]);
        // update parent

        $unit = self::find($request->id);
        $faculty = self::find($request->faculty);
        if($faculty) {
            $unit->makeChildOf($faculty);
        }
    }

    public static function deleteRecord($request)
    {
        DB::table('units')
            ->where('id', $request->id)
            ->delete();
    }

    public function instructors()
    {
        return $this->hasMany('App\Models\Instructor');
    }
}
