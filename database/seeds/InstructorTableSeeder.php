<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InstructorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       DB::table('instructors')->insert([
           [
               'id' => '10',
               'name' => 'Lê Văn A',
               'unit_id' => '1',
               'user_id' => '8',

           ],
           [
               'id' => '11',
               'name' => 'Bùi Văn H',
               'unit_id' => '2',
               'user_id' => '9',
           ],
        ]);
    }
}
