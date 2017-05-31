<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BranchesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('branches')->insert([
            [
                'name' => 'Khoa học máy tính Nhiệm vụ chiến lược',
                'faculty_id' => 1,
            ],
            [
                'name' => 'Khoa học máy tính Chất lượng cao',
                'faculty_id' => 1,
            ],
            [
                'name' => 'Khoa học máy tính',
                'faculty_id' => 1,
            ],
            [
                'name' => 'Công nghệ kỹ thuật điện tử, truyền thông Nhiệm vụ chiến lược',
                'faculty_id' => 11,
            ],
            [
                'name' => 'Công nghệ kỹ thuật điện tử, truyền thông Chất lượng cao',
                'faculty_id' => 11,
            ],
            [
                'name' => 'Công nghệ kỹ thuật điện tử, truyền thông',
                'faculty_id' => 11,
            ],
            [
                'name' => 'Công nghệ thông tin Chất lượng cao',
                'faculty_id' => 1,
            ],
            [
                'name' => 'Công nghệ thông tin',
                'faculty_id' => 1,
            ],
            [
                'name' => 'Hệ thống thông tin',
                'faculty_id' => 1,
            ],
            [
                'name' => 'Truyền thông và mạng máy tính',
                'faculty_id' => 1,
            ],
            [
                'name' => 'Vật lý kỹ thuật',
                'faculty_id' => 18,
            ],
            [
                'name' => 'Kỹ thuật năng lượng',
                'faculty_id' => 18,
            ],
            [
                'name' => 'Cơ kỹ thuật',
                'faculty_id' => 23,
            ],
            [
                'name' => 'Công nghệ kỹ thuật cơ điện tử',
                'faculty_id' => 23,
            ],
        ]);
    }
}
