<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(UnitsTableSeeder::class);
        $this->call(ScopesTableSeeder::class);
        $this->call(BranchesTableSeeder::class);
        $this->call(CoursesTableSeeder::class);
        $this->call(InstructorTableSeeder::class);
        $this->call(TimeTableSeeder::class);
        $this->call(StudentTableSeeder::class);
        $this->call(TopicTableSeeder::class);
    }
}
