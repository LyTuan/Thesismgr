<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'username' => 'superadmin',
                'email' => 'superadmin@vnu.edu.vn',
                'password' => bcrypt('12345'),
                'role' => '0', // superadmin
                'faculty_id' => null,
            ],
            [
                'username' => 'fitadmin',
                'email' => 'fitadmin@vnu.edu.vn',
                'password' => bcrypt('12345'),
                'role' => '1', //admin
                'faculty_id' => '1',
            ],
            [
                'username' => 'fetadmin',
                'email' => 'fetadmin@vnu.edu.vn',
                'password' => bcrypt('12345'),
                'role' => '1', //admin
                'faculty_id' => '11',
            ],


            [
                'username' => 'Nguyen Van A',
                'email' => '1@vnu.edu.vn',
                'password' => bcrypt('12345'),
                'role' =>'3',
                'faculty_id' => '1',
            ],
              [
                'username' => 'Nguyen Van B',
                'email' => '2@vnu.edu.vn',
                'password' => bcrypt('12345'),
                'role' =>'3',
                  'faculty_id' => '1',
            ],
              [
                'username' => 'Nguyen Van C',
                'email' => '3@vnu.edu.vn',
                'password' => bcrypt('12345'),
                'role' =>'3',
                  'faculty_id' => '1',
            ],
              [
                'username' => 'Nguyen Van D',
                'email' => '4@vnu.edu.vn',
                'password' => bcrypt('12345'),
                'role' =>'3',
                  'faculty_id' => '1',
            ],[
                'username' => 'Lê Văn A',
                'email'  => '10@vnu.edu.vn',
                'password' => bcrypt('12345'),
                'role' => '2',
                'faculty_id' => '1',
            ],[
                'username' => 'Bùi Văn H',
                'email' => '11@vnu.edu.vn',
                'password' => bcrypt('12345'),
                'role' => '2',
                'faculty_id' => '1',
            ]
        ]);
    }
}
