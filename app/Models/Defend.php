<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Mail;
use App\Mail\studentHasTopic;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Response;

class Defend extends Model
{
    public static function getAssignReviewReport()
    {

        $_data = DB::table('students')
            ->join('courses','courses.year','=','students.course_id')
            ->join('branches','branches.id','=','students.branch_id')
            ->leftjoin('topic','students.id','=','topic.student_id')
            ->join('users','users.id','=','students.user_id')
            ->leftjoin('instructors', 'topic.instructor_id','=','instructors.id')
            ->leftjoin('defend_scheduler', 'topic.id','=', 'defend_scheduler.topic_id')
            ->select('students.id as student_id','students.name as student_name','courses.name as course_name','branches.name as branch_name', 'topic.name as topic_name', 'instructors.name as instructor_name', 'defend_scheduler.time as time')
            ->where([
                ['students.status_register','=','5'],
                ['users.faculty_id','=',Auth::user()->faculty_id],
            ])
            ->get();

            $stt = 1;
            foreach ($_data as &$data) {
                $row[] = array(
                    $stt++,
                    $data->student_id,
                    $data->student_name,
                    $data->course_name,
                    $data->branch_name,
                    $data->topic_name,
                    $data->instructor_name,
                    $data->time
                );
            }


        return Excel::create('Lich phan cong bao ve', function($excel) use($row)
        {
            $excel->sheet('Sheet1', function($sheet) use($row)
            {
                $headings = array('STT', 'Mã sinh viên ', 'Họ và tên','Khóa','Chương trình đào tạo', 'Tên đề tài', 'Giáo viên hướng dẫn', 'Thời gian bảo vệ dự kiến');
                $sheet->prependRow(1,$headings);
                $sheet->fromArray($row, null, 'A2', false, false);
            });
        },null,'A3',true);
    }

    public static function getExportEnd(){
        return Excel::create('Danh sach thanh vien hoi dong', function($excel)
        {
            $excel->sheet('Sheetname', function($sheet)
            {
                $headings = array('STT', 'Mã', 'Họ và tên', 'Đơn vị');
                $_data= DB::table('instructors')
                    ->join('units','instructors.unit_id','=','units.id')
                    ->join('users','users.id','=','instructors.user_id')
                    ->select('instructors.id as id','instructors.name as name', 'units.name as unit')
                    ->where('faculty_id','=',Auth::user()->faculty_id)
                    ->get();
                $stt = 1;
                $sheet->prependRow(1,$headings);
                foreach ($_data as &$data) {
                    $row[] = array(
                        $stt++,
                        $data->id,
                        $data->name,
                        $data->unit
                    );
                }
                $sheet->fromArray($row, null, 'A2', false, false);


            });
        },null,'A3',true);
    }

    public static function getSuggestExport()
    {
        $headers = array(
            "Content-type"=>"text/html",
            "Content-Disposition"=>"attachment;Filename=myfile.doc"
        );

        $file = public_path(). "/download/";

        $content = '<html>
                    <head>
                    <meta charset="utf-8">
                    </head>
                    <body>
                        <p>
                            My Content
                        </p>
                    </body>
                    </html>';

        // return Response::make($content,200, $headers);
        return Response::download($content,200,$headers);
    }
}