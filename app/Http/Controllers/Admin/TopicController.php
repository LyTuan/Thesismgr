<?php
/**
author: Ly Tuan
gmail: lytuanduong96@gmail.com
 */
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\AddStudentCanRequest;
use App\Models\Topic;
use App\Models\Instructor;
use App\Models\WaitingTopic;
use App\Models\Time;
use App\Models\Student;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;
use App\Http\Requests\PostTopicRequest;

class TopicController extends Controller
{
    // var $status_on_off = true;
    // And student enough conditon
    public function getStudentCanAdd(){

        return view('admin.topic.addStudentCan');
    }
    // Add student enough condition by Excel file
    public function postStudentCanAdd(AddStudentCanRequest $request){
        $file = $request->input('byFile');

        if($file) {
            // validate
            $file = fopen($request->file, "r");
            $mime = mime_content_type($file);
            $excel = [
                'application/vnd.ms-excel',
                'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                'application/octet-stream',
            ];
            fclose($file);
            //action
            if(array_search($mime, $excel)) {
                $input = Input::file('file');
                Topic::addStudentCanByFile($input);
                Session::flash('success', 'Đã thêm thành công sinh viên đủ điều kiện!');
            }
        }else{
            Topic::addStudentCan($request);
        }
        return redirect()->route('getStudentCanAdd');
    }
    // Send email to student enough  enough condition
    public function sendMailStudentCan(){
        Topic::sendMailStudentCan();
        return redirect()->route('managerRegister');
    }
    public function managerRegister(){
        $topic_array = Topic::all();
        foreach($topic_array as $topic){
            $student_array[] = $topic->student;
        }
        foreach($topic_array as $topic){
            $instructor_array[] = Instructor::find($topic->instructor_id);
        }

        return view('admin.topic.manager',['topic_array'=>$topic_array,'student_array' =>$student_array,'instructor_array'=>$instructor_array]);
    }
    // Turn on for register Topic
    public function turnOnRegister(){
        Time::turnOnRegisterTopic();
        Session::flash('flash-level','success');
        Session::flash('flash-message','Đã mở đăng ký');
        return redirect()->route('managerRegister');

    }
    // Turn off register Topic
    public function turnOffRegister(){
        Time::turnOffRegisterTopic();
        Session::flash('flash-level','success');
        Session::flash('flash-message','Đã đóng đăng ký');
        return redirect()->route('managerRegister');
    }
    // Register Topic
    public function topicRegister(){
        $status_register = Time::getTopicStatus();
        $list_instructor = Instructor::getListInstructor();
        return view('admin.topic.registerTopic',['list_instructor'=>$list_instructor,'topic_status'=>$status_register]);
    }
    //Post Topic register
    public function postTopic(PostTopicRequest $request){
        Topic::addTopic($request);
        return redirect()->route('registerTopic');
    }

    //Export file word list student register
    public function exportWordFile(){
        $topic_array = Topic::all();
        foreach($topic_array as $topic){
            $student_array[] = $topic->student;
        }
        foreach($topic_array as $topic){
            $instructor_array[] = Instructor::find($topic->instructor_id);
        }

        return view('admin.file.fileListRegister',['topic_array'=>$topic_array,'student_array' =>$student_array,'instructor_array'=>$instructor_array]);

    }

    public function exportWordFileEditTopic(){

        $student_count = Student::where('status_register',3)->count();
        if($student_count>0){
            $student_array = Student::where('status_register',3)->get();
            foreach($student_array as $student){
                $topic_count = Topic::where('instructor_accept',1)->count();
                if($topic_count>0){
                    $topic_array[] = $student->topic;
                    $waiting_topic = WaitingTopic::where('student_id',$student->id)->get()->first();
                    $topic = $student->topic;
                    $topic->name = $waiting_topic->new_name;
                    $topic->instructor_id = $waiting_topic->new_teacher;
                    $topic->save();    
                }else{
                    Session::flash('flash-level','success');
                    Session::flash('flash-message','Đã thay đổi thành công');
                    return view('errors.503');
                }
                
            }
            foreach($topic_array as $topic){
                $instructor_array[] = Instructor::find($topic->instructor_id);
            }

            return view('admin.file.fileEditRegister',['topic_array' => $topic_array,'student_array' => $student_array,'instructor_array'=>$instructor_array]);
        }else{
            return view('errors.503');
        }



    }
    public function exportWordFileCancelTopic(){

        $student_count = Student::where('status_register',2)->count();
        if($student_count>0){
            $student_array = Student::where('status_register',2)->get();
            foreach($student_array as $student){
                $topic_array[] = $student->topic;
                Topic::where('student_id',$student->id)->delete();
            }

           
            foreach($topic_array as $topic){
                $instructor_array[] = Instructor::find($topic->instructor_id);
            }

            return view('admin.file.fileCancelRegister',['topic_array' => $topic_array,'student_array' => $student_array,'instructor_array'=>$instructor_array]);
        }else{
            return view('errors.503');
        }



    }
}
