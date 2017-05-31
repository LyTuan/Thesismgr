<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class WaitingTopic extends Model
{
    protected $table = 'waiting_topic';

    protected $fillable = array('student_id','new_name','new_teacher');

    public static function addWaitingTopic($request){
        $student = Auth::user()->student;
        if(WaitingTopic::checkExitStudent()==false){
            $student_id = $student->id;
            $waiting_topic = WaitingTopic::where('student_id',$student_id)->update(['new_name'=>$request->topic,'new_teacher'=>$request->instructor]);
            $student = Auth::user()->student;
            $student->status_register =3;
            $student->save();
            Session::flash('flash-level','success');
            Session::flash('flash-message','Chỉnh sửa thành công');
        }else{
            $waiting_topic = new WaitingTopic;
            $waiting_topic->student_id = Auth::user()->student->id;
            $waiting_topic->new_name = $request->topic;
            $waiting_topic->new_teacher = $request->instructor;
            $waiting_topic->save();
            $student = Auth::user()->student;
            $student->status_register =3;
            $student->save();
            Session::flash('flash-level','success');
            Session::flash('flash-message',' Gửi chỉnh sửa thành công');
        }

    }
    public static function checkExitStudent(){
        $student = Auth::user()->student;
        $count =WaitingTopic::where('student_id',$student->id)->count();
        if($count ==0){
            return true;
        }else{
            return false;
        }
    }

}
