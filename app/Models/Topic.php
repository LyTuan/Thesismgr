<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Mail;
use App\Mail\StudentCanAddMail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class Topic extends Model
{
    protected $table = 'topic';

    protected $fillable = array('id','content','student_id','instructor_id');

    public static function addStudentCan($request){
        $id = $request->id;
        $student = Student::find($id);
        if($student){
            $student->status = '1';
            $student->save();
            Session::flash('flash-level','success');
            Session::flash('flash-message','Thêm sinh viên đủ điều kiện thành công');
        }else{
            Session::flash('flash-level','danger');
            Session::flash('flash-message','Không tìm thấy sinh viên');
        }


    }
    public static function addStudentCanByFile($file){
        Excel::load($file, function($reader){
            $reader->each(function($sheet){
                $row = $sheet->toArray();
                $request = [];
                $request['id']  = $row['id'];
                self::addStudentCan((object)$request);
                Session::flash('flash-level','success');
                Session::flash('flash-message','Thêm sinh viên đủ điều kiện thành công');
            });
        });
    }
    public static function sendMailStudentCan(){
        $studentArray = Student::where('status',1)->get();
        foreach ($studentArray as $student ) {
            $user = User::find($student->user_id);
            if($user->email!=null&&$user->email!=''){
                Mail::to($user->email)->send(new StudentCanAddMail());
            }
        }
        Session::flash('flash-level','success');
        Session::flash('flash-message','Đã gửi mail thành công');

    }
    public static function addTopic($request){
        $findTopic = Topic::where('name',$request->topic)->count();
        // dd($findTopic);
        if($findTopic!=0){
            Session::flash('flash-level','danger');
            Session::flash('flash-message','Trùng đề tài! Vui lòng nhập lại');
        }else{
            $check_student = Topic::where('student_id',Auth::user()->student->id)->count();
            if($check_student>0){
                Session::flash('flash-level','danger');
                Session::flash('flash-message','Bạn đã đăng ký');
            }else{
                $topic = new Topic();
                $topic->name = $request->topic;
                $student= Auth::user()->student;
                $topic->student_id = $student->id;
                $topic->instructor_id = $request->instructor;
                $topic->save();
                Session::flash('flash-level','success');
                Session::flash('flash-message','Đăng ký thành công');
            }

        }

    }
    public static function cancelRegister($id){
        $student = Auth::user()->student;
        $student->status_register =2;
        $student->save();
        Session::flash('flash-level','success');
        Session::flash('flash-message','Đã đề nghị hủy đề tài');
    }

    public static function editRegister(){
        $student = Auth::user()->student;
        $student->status_register= 3;
        $student->save();

    }
    public static function acceptTopic($topic_id){

        $topic = Topic::find($topic_id);
        $topic->instructor_accept = 1;
        $topic->save();
        Session::flash('flash-level','success');
        Session::flash('flash-message','Bạn đã  chấp nhận thành công');
    }
    public static function denyTopic($topic_id){
        $topic = Topic::find($topic_id);
        $topic->instructor_accept = 0;
        $topic->save();
        Session::flash('flash-level','success');
        Session::flash('flash-message','Bạn đã  không chấp nhận thành công');

    }
    public static function postTopicEdit($request){

    }
    public function instructors(){
        return $this->belongsTo('App\Models\Instructor');
    }
    public function student(){
        return $this-> belongsTo('App\Models\Student');
    }
}
