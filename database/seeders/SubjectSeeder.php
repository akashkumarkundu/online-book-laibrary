<?php

namespace Database\Seeders;

use App\Models\Subject;
use Illuminate\Database\Seeder;

class SubjectSeeder extends Seeder
{
    public function run(): void
    {
        $subjects = [
            ['name' => 'বাংলা (Bangla)', 'slug' => 'bangla', 'code' => 'bangla', 'icon' => 'book'],
            ['name' => 'English', 'slug' => 'english', 'code' => 'english', 'icon' => 'languages'],
            ['name' => 'গণিত (Mathematics)', 'slug' => 'math', 'code' => 'math', 'icon' => 'calculator'],
            ['name' => 'বিজ্ঞান (General Science)', 'slug' => 'science', 'code' => 'science', 'icon' => 'microscope'],
            ['name' => 'ধর্ম ও নৈতিক শিক্ষা (Religion)', 'slug' => 'religion', 'code' => 'religion', 'icon' => 'heart-handshake'],
            ['name' => 'বাংলাদেশ ও বিশ্বপরিচয় (BGS)', 'slug' => 'bgs', 'code' => 'bgs', 'icon' => 'globe'],
            ['name' => 'তথ্য ও যোগাযোগ প্রযুক্তি (ICT)', 'slug' => 'ict', 'code' => 'ict', 'icon' => 'laptop'],
            ['name' => 'পদার্থবিজ্ঞান (Physics)', 'slug' => 'physics', 'code' => 'physics', 'icon' => 'atom'],
            ['name' => 'রসায়ন (Chemistry)', 'slug' => 'chemistry', 'code' => 'chemistry', 'icon' => 'flask-conical'],
            ['name' => 'জীববিজ্ঞান (Biology)', 'slug' => 'biology', 'code' => 'biology', 'icon' => 'dna'],
            ['name' => 'উচ্চতর গণিত (Higher Math)', 'slug' => 'higher-math', 'code' => 'higher_math', 'icon' => 'binary'],
            ['name' => 'হিসাববিজ্ঞান (Accounting)', 'slug' => 'accounting', 'code' => 'accounting', 'icon' => 'receipt'],
        ];

        foreach ($subjects as $subject) {
            Subject::updateOrCreate(['code' => $subject['code']], $subject);
        }
    }
}
