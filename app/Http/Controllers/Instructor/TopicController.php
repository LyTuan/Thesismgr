<?php

namespace App\Http\Controllers\Instructor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\AddStudentCanRequest;
use App\Models\Topic;
use App\Models\Instructor;
use App\Models\Time;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\PostTopicRequest;

class TopicController extends Controller
{
    public function getTopicAccept(){
        $instructor= Auth::user()->instructor;
        $topic_all = Topic::all();

        foreach($topic_all as $topic){
            if($topic->instructor_id == $instructor->id ){
                $topic_array[] = $topic;
                $student_array[] = $topic->student;
            }
        }
        return view('instructor.aceptTopic',['topic_array'=>$topic_array,'student_array' =>$student_array]);
    }
    public function acceptTopic($topic_id){
        Topic::acceptTopic($topic_id);
        return redirect()->route('getTopicAccept');
    }
    public function denyTopic($topic_id){
        Topic::denyTopic($topic_id);
        return redirect()->route('getTopicAccept');
    }

}
