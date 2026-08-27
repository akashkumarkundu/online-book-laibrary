<?php

namespace Database\Seeders;

use App\Models\GradeLevel;
use Illuminate\Database\Seeder;

class GradeLevelSeeder extends Seeder
{
    public function run(): void
    {
        $grades = [
            ['name' => 'Class 1 (১ম শ্রেণী)', 'slug' => 'class-1', 'code' => 'class_1', 'category' => 'primary', 'sort_order' => 1],
            ['name' => 'Class 2 (২য় শ্রেণী)', 'slug' => 'class-2', 'code' => 'class_2', 'category' => 'primary', 'sort_order' => 2],
            ['name' => 'Class 3 (৩য় শ্রেণী)', 'slug' => 'class-3', 'code' => 'class_3', 'category' => 'primary', 'sort_order' => 3],
            ['name' => 'Class 4 (৪র্থ শ্রেণী)', 'slug' => 'class-4', 'code' => 'class_4', 'category' => 'primary', 'sort_order' => 4],
            ['name' => 'Class 5 (৫ম শ্রেণী - PEC)', 'slug' => 'class-5', 'code' => 'class_5', 'category' => 'primary', 'sort_order' => 5],
            ['name' => 'Class 6 (৬ষ্ঠ শ্রেণী)', 'slug' => 'class-6', 'code' => 'class_6', 'category' => 'junior', 'sort_order' => 6],
            ['name' => 'Class 7 (৭ম শ্রেণী)', 'slug' => 'class-7', 'code' => 'class_7', 'category' => 'junior', 'sort_order' => 7],
            ['name' => 'Class 8 (৮ম শ্রেণী - JSC)', 'slug' => 'class-8', 'code' => 'class_8', 'category' => 'junior', 'sort_order' => 8],
            ['name' => 'Class 9 (৯ম শ্রেণী)', 'slug' => 'class-9', 'code' => 'class_9', 'category' => 'secondary', 'sort_order' => 9],
            ['name' => 'Class 10 (১০ম শ্রেণী - SSC)', 'slug' => 'class-10', 'code' => 'class_10', 'category' => 'secondary', 'sort_order' => 10],
            ['name' => 'Class 11 (একাদশ শ্রেণী - HSC 1st)', 'slug' => 'class-11', 'code' => 'class_11', 'category' => 'higher_secondary', 'sort_order' => 11],
            ['name' => 'Class 12 (দ্বাদশ শ্রেণী - HSC 2nd)', 'slug' => 'class-12', 'code' => 'class_12', 'category' => 'higher_secondary', 'sort_order' => 12],
        ];

        foreach ($grades as $grade) {
            GradeLevel::updateOrCreate(['code' => $grade['code']], $grade);
        }
    }
}
