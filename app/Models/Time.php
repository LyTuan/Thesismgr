<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Time extends Model
{
    protected $table = 'times';

    protected $fillable = array('topic_status','security_status');

    public static function turnOnRegisterTopic(){
        $time = Time::find(1);
        $time->topic_status = 1;
        $time->save();
    }
    public static function turnOffRegisterTopic(){
        $time =  Time::find(1);
        $time->topic_status = 0;
        $time->save();
    }
    public static function getTopicStatus(){
        $time = Time::find(1);
        return $time->topic_status;
    }

    public static function turnOnRecordRegister(){
        DB::table('times')
            ->where('id',1)
            ->update(['security_status' => 1]);
    }

    public static function turnOffRecordRegister(){
        DB::table('times')
            ->where('id',1)
            ->update(['security_status' => 0]);
    }

    public static function getRecordRegisterStatus(){
        return DB::table('times')
            ->where('id',1)
            ->select('security_status')->first()->security_status;
    }
}
