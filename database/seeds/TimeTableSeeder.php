<?php

use Illuminate\Database\Seeder;

class TimeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('times')->insert(
        	[
        		'id'=> '1',
        		'topic_status'=>'0',
        		'security_status'=>'0',
        	]
        );
    }
}
