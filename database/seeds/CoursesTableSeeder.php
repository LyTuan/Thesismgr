<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CoursesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('courses')->insert([
            [
                'year' => '2013',
                'name' => 'QH-2013-I/CQ',
                'alias' => 'K58',
            ],
            [
                'year' => '2014',
                'name' => 'QH-2014-I/CQ',
                'alias' => 'K59',
            ],
            [
                'year' => '2015',
                'name' => 'QH-2015-I/CQ',
                'alias' => 'K60',
            ],
            [
                'year' => '2016',
                'name' => 'QH-2016-I/CQ',
                'alias' => 'K61',
            ],
        ]);
    }
}
