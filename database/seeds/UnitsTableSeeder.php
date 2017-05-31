<?php

use Illuminate\Database\Seeder;
use App\Models\Unit;

class UnitsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $units = [
            [
                'id' => 1, 'name' => 'Công nghệ thông tin', 'children' =>
                [
                    ['id' => 2, 'name' => 'Bộ môn Các Hệ thống Thông tin'],
                    ['id' => 3, 'name' => 'Bộ môn Công nghệ Phần mềm'],
                    ['id' => 4, 'name' => 'Bộ môn Khoa học Máy tính'],
                    ['id' => 5, 'name' => 'Bộ môn Khoa học và Kỹ thuật tính toán'],
                    ['id' => 6, 'name' => 'Bộ môn Mạng và Truyền thông Máy tính'],
                    ['id' => 7, 'name' => 'Phòng thí nghiệm An toàn thông tin'],
                    ['id' => 8, 'name' => 'Phòng thí nghiệm Công nghệ Tri thức'],
                    ['id' => 9, 'name' => 'Phòng thí nghiệm Bộ môn Hệ thống nhúng'],
                    ['id' => 10, 'name' => 'Phòng thí nghiệm Tương tác Người - Máy'],
                ]
            ],
            [
                'id' => 11, 'name' => 'Điện tử viễn thông', 'children' =>
                [
                    ['id' => 12, 'name' => 'Bộ môn Hệ thống Viễn thông'],
                    ['id' => 13, 'name' => 'Bộ môn Thông tin Vô tuyến'],
                    ['id' => 14, 'name' => 'Bộ môn Điện tử và Kỹ thuật máy tính'],
                    ['id' => 15, 'name' => 'Bộ môn Vi cơ Điện tử và Vi cơ Hệ thống'],
                    ['id' => 16, 'name' => 'Phòng thí nghiệm Tín hiệu và Hệ thống'],
                    ['id' => 17, 'name' => 'Phòng thực hành Điện tử Viễn thông'],
                ]
            ],
            [
                'id' => 18, 'name' => 'Vật lý kỹ thuật và công nghệ nano', 'children' =>
                [
                    ['id' => 19, 'name' => 'Bộ môn Vật liệu và linh kiện từ tính nano'],
                    ['id' => 20, 'name' => 'Bộ môn Vật liệu và linh kiện bán dẫn nano'],
                    ['id' => 21, 'name' => 'Bộ môn Công nghệ nano sinh học'],
                    ['id' => 22, 'name' => 'Bộ môn Công nghệ quang tử'],
                ]
            ],
            [
                'id' => 23, 'name' => 'Cơ học kỹ thuật và tự động hóa', 'children' =>
                [
                    ['id' => 24, 'name' => 'Bộ môn Công nghệ biển và môi trường'],
                    ['id' => 25, 'name' => 'Bộ môn Công nghệ cơ điện tử'],
                    ['id' => 26, 'name' => 'Bộ môn Thủy khí công nghiệp và môi trường'],
                    ['id' => 27, 'name' => 'Phòng thí nghiệm vật liệu và kết cấu tiên tiến'],
                ]
            ],
        ];

        Unit::buildTree($units);
    }
}
