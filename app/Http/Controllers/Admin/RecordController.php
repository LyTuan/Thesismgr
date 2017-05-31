<?php
namespace App\Http\Controllers\Admin;

use Excel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\AddStudentCanRequest;
use App\Models\Record;
use App\Models\Time;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;
use App\Http\Requests\PostTopicRequest;
use Yajra\Datatables\Datatables;
use App\Models\Unit;
use Illuminate\Support\Facades\Auth;


class RecordController extends Controller
{

    public function managerRecordTopic(){
        $stt = Time::getRecordRegisterStatus();
        return view('admin.record.manager',compact('stt'));
    }



    // Turn on for register Topic
    public function turnOnRecordRegister(){
        Time::turnOnRecordRegister();
        Session::flash('flash-level','success');
        Session::flash('flash-message','Đã mở hạn nộp hồ sơ bảo vệ');
        return redirect()->route('managerRecordTopic');
    }


    // Turn off register Topic
    public function turnOffRecordRegister(){
        Time::turnOffRecordRegister();
        Session::flash('flash-level','success');
        Session::flash('flash-message','Đã đóng hạn nộp hồ sơ bảo vệ');
        return redirect()->route('managerRecordTopic');
    }



    // Register Topic
    public function receiveRecordMark(){
//        $student_list = DB::table('students')
//            ->join('courses','courses.year','=','students.course_id')
//            ->join('branches','branches.id','=','students.branch_id')
//            ->leftjoin('topic','students.user_id','=','topic.student_id')
//            ->leftjoin('instructors', 'topic.instructor_id','=','instructors.id')
//            ->join('users','users.id','=','students.user_id')
//            ->select('students.user_id as student_id','students.name as student_name','courses.name as course_name','branches.name as branch_name', 'topic.name as topic_name', 'instructors.name as instructor_name')
//            ->where([
//                ['students.status_register','=',0],
//                ['users.faculty_id','=',Auth::user()->faculty_id]
//            ])
//            ->get();
        // $student_list = DB::table('students')
        //                      ->join('users','users.id','=','students.user_id')
        //                      ->where('users.faculty_id', '=', '1')
        //                      ->get();

//        echo Auth::user()->faculty_id;
//        var_dump($student_list);
         return view('admin.record.receiveRecordMark');
    }

    public function checkValidRecord(){
        return view('admin.record.checkValidRecord');
    }

    public function sendMailStudentHasTopic(){
        Record::sendMailStudentHasTopic();
        return redirect()->route('managerRecordTopic');
    }

    public function resendMailNoti(){
        Record::sendMailStudentHasTopic();
        return redirect()->route('receiveRecordMark');
    }



    public function export_RecordValidList(){
        return Record::getRecordValidReport()->export('xlsx');
    }


    //for datatable
    public function apiStudent() {
        $student_list = DB::table('students')
            ->join('courses','courses.year','=','students.course_id')
            ->join('branches','branches.id','=','students.branch_id')
            ->leftjoin('topic','students.id','=','topic.student_id')
            ->leftjoin('instructors', 'topic.instructor_id','=','instructors.id')
            ->join('users','users.id','=','students.user_id')
            ->select('students.id as student_id','students.name as student_name','courses.name as course_name','branches.name as branch_name', 'topic.name as topic_name', 'instructors.name as instructor_name')
            ->where([
                ['students.status_register','=',4],
                ['users.faculty_id','=',Auth::user()->faculty_id]
            ])
            ->get();
        return Datatables::of($student_list)
            ->addColumn('action', function ($student) {
                return '<button id="delete' .$student->student_id. '" type="button" class="btn btn-primary" onclick="deleteModal(' .$student->student_id. ')">'.
                'Xác nhận nộp'.
                '</button>';
            })
            ->make(true);
    }


    // update
    public function postRecordCheckDelete(Request $request) {
        $this->validate($request, $rules = [
            'id' => 'required|numeric',
        ]);
        DB::table('students')
            ->where('id',$request->id)
            ->update(['status_register' => 5]);

        return redirect()->route('receiveRecordMark');
    }

}
