<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Mail;
use App\Mail\StudentHasTopic;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use App\Models\Student;

class Record extends Model
{

    public static function sendMailStudentHasTopic(){
        $studentArray = Student::where('status_register',4)->get();
        foreach ($studentArray as $student ) {
            if($student->user->email != null && $student->user->email != ''){
                Mail::to($student->user->email)->send(new StudentHasTopic());
                Session::flash('flash-level','success');
                Session::flash('flash-message','Đã gửi mail thành công');
            }
        }
    }



    // export list student have been register defend record
    public static function getRecordValidReport()
    {

        $_data = DB::table('students')
            ->join('courses','courses.year','=','course_id')
            ->join('branches','branches.id','=','branch_id')
            ->leftjoin('topic','students.id','=','topic.student_id')
            ->leftjoin('instructors', 'topic.instructor_id','=','instructors.id')
            ->join('users','users.id','=','students.user_id')
            ->select('students.id as student_id','students.name as student_name','courses.name as course_name','branches.name as branch_name', 'topic.name as topic_name', 'instructors.name as instructor_name')
            ->where([
                ['students.status','=','1'],
                ['users.faculty_id','=',Auth::user()->faculty_id],
            ])
            ->get();

        // dd($_data);
        $stt = 1;
        foreach ($_data as &$data) {
            $row[] = array(
                $stt++,
                $data->student_id,
                $data->student_name,
                $data->course_name,
                $data->branch_name,
                $data->topic_name,
                $data->instructor_name
            );
        }

        return  Excel::create('Danh sach duoc bao ve ', function($excel) use($row)
        {
            $excel->sheet('Sheet1', function($sheet) use($row)
            {
                $headings = array('STT', 'Mã sinh viên', 'Họ và tên', 'Khóa học','Chương trình đào tạo','Tên đề tài', 'Giáo viên hướng dẫn');
                $stt = 1;
                $sheet->prependRow(1,$headings);
                $sheet->fromArray($row, null, 'A2', false, false);

            });

        });

    }


}