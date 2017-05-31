<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TopicTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('topic')->insert([
            [
                'name' => 'Kiểm thử hệ thống đánh giá năng lực',
                'student_id' => '1',
                'instructor_id' => '10',

            ],
            [
                'name' => 'Phân tích nội dung post bài trên mạng xã hội',
                'student_id' => '2',
                'instructor_id' => '11',

            ],


        ]);
    }
}
