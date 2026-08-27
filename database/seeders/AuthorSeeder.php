<?php

namespace Database\Seeders;

use App\Models\Author;
use Illuminate\Database\Seeder;

class AuthorSeeder extends Seeder
{
    public function run(): void
    {
        $authors = [
            ['name' => 'NCTB (জাতীয় শিক্ষাক্রম ও পাঠ্যপুস্তক বোর্ড)', 'slug' => 'nctb-board', 'bio' => 'বাংলাদেশ সরকারের এনসিটিবি অনুমোদিত অফিশিয়াল কারিকুলাম ও পাঠ্যপুস্তক।'],
            ['name' => 'প্রফেসর মো: হাজারী ও নাগ', 'slug' => 'hajari-nag', 'bio' => 'উচ্চমাধ্যমিক রসায়ন বইয়ের প্রখ্যাত লেখক ও গবেষক।'],
            ['name' => 'ড. শাহজাহান তপন ও রানা চৌধুরী', 'slug' => 'shahjahan-tapan', 'bio' => 'উচ্চমাধ্যমিক পদার্থবিজ্ঞান বিষয়ের স্বনামধন্য লেখক।'],
            ['name' => 'কেতাব উদ্দীন আহমেদ', 'slug' => 'ketab-uddin', 'bio' => 'এইচএসসি উচ্চতর গণিত বইয়ের জনপ্রিয় লেখক।'],
            ['name' => 'ড. মো: আবুল হাসান', 'slug' => 'abul-hasan', 'bio' => 'উচ্চমাধ্যমিক উদ্ভিদবিজ্ঞান (Botany) বইয়ের প্রখ্যাত রচয়িতা।'],
            ['name' => 'গাজী আজমল ও গাজী আসমত', 'slug' => 'gazi-ajmal', 'bio' => 'এইচএসসি প্রাণীবিজ্ঞান (Zoology) বইয়ের প্রখ্যাত লেখক দ্বয়।'],
            ['name' => 'প্রকৌশলী মুজিবুর রহমান', 'slug' => 'mujibur-rahman', 'bio' => 'উচ্চমাধ্যমিক আইসিটি (ICT) বিষয়ের জনপ্রিয় লেখক।'],
        ];

        foreach ($authors as $author) {
            Author::updateOrCreate(['slug' => $author['slug']], $author);
        }
    }
}
