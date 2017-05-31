<?php

namespace App\Http\Controllers\Student;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Time;
use App\Models\Topic;
use App\Models\WaitingTopic;
use Illuminate\Support\Facades\Session;
use App\Models\Instructor;
use App\Http\Requests\PostTopicRequest;
use Illuminate\Support\Facades\Auth;

class TopicController extends Controller
{

    public function getViewRegister(){
        $status_register = Time::getTopicStatus();
        $list_instructor = Instructor::getListInstructor();
        return view('student.topicRegister',['list_instructor'=>$list_instructor,'topic_status'=>$status_register]);
    }

    public function postTopicStudent(PostTopicRequest $request){
        Topic::addTopic($request);
        return redirect()->route('topicRegister');
    }
    //List all topic of user registed
    public function listRegister(){
        $student = Auth::user()->student;
        // dd($student->id);
        $all_topic = Topic::all();
        foreach($all_topic as $topic){
            if($topic->student_id==$student->id){
                $topic_array[]=$topic;
                $student_array[] = $topic->student;
                $instructor_array[] = Instructor::find($topic->instructor_id);

            }

        }
        return view('student.listRegister',['topic_array'=>$topic_array,'student_array' =>$student_array,'instructor_array'=>$instructor_array]);
    }
    public function editRegister($id){
        $all_topic = Topic::all();
        $status_register = Time::getTopicStatus();
        $topic = Topic::find($id);
        $instructor = Instructor::find($topic->instructor_id);
        foreach($all_topic as $tpCount){
            $instructor_array[] = Instructor::find($tpCount->instructor_id);
        }
        return view('student.editRegister',['topic'=>$topic,'instructor'=>$instructor,'list_instructor'=>$instructor_array,'topic_status'=>$status_register]);
    }
    public function postTopicEdit(PostTopicRequest $request){
        WaitingTopic::addWaitingTopic($request);
        return redirect()->route('listRegister');
    }
    public function cancelRegister($id){
        Topic::cancelRegister($id);
        return redirect()->route('listRegister');
    }



}