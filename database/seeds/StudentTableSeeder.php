<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StudentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
   		 DB::table('students')->insert([
             [
                 'id' => '1',
                 'name' => 'Nguyen Van A',
                 'course_id' => '2013',
                 'branch_id' => '1',
                 'status' => '1',
                 'status_register'=>'0',
                 'user_id' => '4',
             ],
             [
                 'id' => '2',
                 'name' => 'Nguyen Van B',
                 'course_id' => '2014',
                 'branch_id' => '2',
                 'status' => '1',
                 'status_register'=>'0',
                 'user_id' => '5',
             ],
             [
                 'id' => '3',
                 'name' => 'Nguyen Van C',
                 'course_id' => '2015',
                 'branch_id' => '3',
                 'status' => '0',
                 'status_register' => '0',
                 'user_id' => '6',
             ],
             [
                 'id' => '4',
                 'name' => 'Nguyen Van D',
                 'course_id' => '2015',
                 'branch_id' => '1',

                 'status' => '0',
                 'status_register' =>'0',
                 'user_id' => '7',
             ],
        ]);
    }
}
