<?php
namespace App\Http\Controllers\Admin;

use DB;
use Excel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\AddStudentCanRequest;
use App\Models\Record;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;
use App\Http\Requests\PostTopicRequest;
use App\Models\Defend;

class DefendController extends Controller
{
    public function assignReview(){
        return view('admin.defend.assignReview');
    }

    public function makeCouncil()
    {
        return view('admin.defend.makeCouncil');
    }

    public function exportEnd(){
        return view('admin.defend.exportEnd');
    }

    public static function assignReview_export(){
        Defend::getAssignReviewReport()->export('xlsx');
    }

    public function makeCouncil_export(){
        Defend::getExportEnd()->export('xlsx');
    }

    public static function docSuggest_export()
    {
        Defend::getSuggestExport();
    }
}
