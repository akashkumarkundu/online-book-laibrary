<?php

namespace Database\Seeders;

use App\Models\Author;
use App\Models\Book;
use App\Models\Chapter;
use App\Models\GradeLevel;
use App\Models\Subject;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class BookSeeder extends Seeder
{
    public function run(): void
    {
        $nctbAuthor = Author::where('slug', 'nctb-board')->first();
        $hajariAuthor = Author::where('slug', 'hajari-nag')->first();
        $tapanAuthor = Author::where('slug', 'shahjahan-tapan')->first();
        $ketabAuthor = Author::where('slug', 'ketab-uddin')->first();
        $mujiburAuthor = Author::where('slug', 'mujibur-rahman')->first();

        $banglaSub = Subject::where('code', 'bangla')->first();
        $englishSub = Subject::where('code', 'english')->first();
        $mathSub = Subject::where('code', 'math')->first();
        $scienceSub = Subject::where('code', 'science')->first();
        $religionSub = Subject::where('code', 'religion')->first();
        $bgsSub = Subject::where('code', 'bgs')->first();
        $ictSub = Subject::where('code', 'ict')->first();
        $physicsSub = Subject::where('code', 'physics')->first();
        $chemistrySub = Subject::where('code', 'chemistry')->first();
        $biologySub = Subject::where('code', 'biology')->first();
        $higherMathSub = Subject::where('code', 'higher_math')->first();
        $accountingSub = Subject::where('code', 'accounting')->first();

        $booksList = [
            // CLASS 1
            [
                'grade' => 'class_1', 'subject_id' => $banglaSub->id, 'author_id' => $nctbAuthor->id,
                'title' => 'আমার বাংলা বই (Class 1)', 'cover_color' => 'from-amber-600 to-orange-700',
                'description' => 'প্রথম শ্রেণীর শিক্ষার্থীদের জন্য এনসিটিবি অনুমোদিত অফিশিয়াল আমার বাংলা পাঠ্যবই।',
                'price' => 120, 'discount_price' => 100, 'isbn' => 'NCTB-C1-BAN-2026', 'publisher' => 'NCTB Board',
                'chapters' => [
                    ['chapter_number' => 1, 'title' => 'অধ্যায় ১: স্বরবর্ণ পাঠ (অ - ঔ)', 'content' => 'অ-তে অজগর, আ-তে আম, ই-তে ইঁদুর ছানা, ঈ-তে ঈগল পাখি।'],
                    ['chapter_number' => 2, 'title' => 'অধ্যায় ২: ব্যঞ্জনবর্ণ পাঠ (ক - ঙ)', 'content' => 'ক-তে কলা, খ-তে খাতা, গ-তে গরু, ঘ-তে ঘাস।']
                ]
            ],
            [
                'grade' => 'class_1', 'subject_id' => $englishSub->id, 'author_id' => $nctbAuthor->id,
                'title' => 'English for Today (Class 1)', 'cover_color' => 'from-blue-600 to-sky-700',
                'description' => 'English for Today standard textbook for Class 1 young learners.',
                'price' => 130, 'discount_price' => 110, 'isbn' => 'NCTB-C1-ENG-2026', 'publisher' => 'NCTB Board',
                'chapters' => [
                    ['chapter_number' => 1, 'title' => 'Unit 1: Alphabet & Greetings', 'content' => 'A for Apple, B for Ball, C for Cat. Hello! Good morning.'],
                    ['chapter_number' => 2, 'title' => 'Unit 2: Numbers & Shapes', 'content' => '1 One, 2 Two, 3 Three. Circle, Square, Triangle.']
                ]
            ],
            [
                'grade' => 'class_1', 'subject_id' => $mathSub->id, 'author_id' => $nctbAuthor->id,
                'title' => 'প্রাথমিক গণিত (Class 1)', 'cover_color' => 'from-emerald-600 to-teal-700',
                'description' => 'প্রথম শ্রেণীর প্রাথমিক গণিত শিক্ষা ও ১-২০ সংখ্যা গণনা বই।',
                'price' => 125, 'discount_price' => 105, 'isbn' => 'NCTB-C1-MAT-2026', 'publisher' => 'NCTB Board',
                'chapters' => [
                    ['chapter_number' => 1, 'title' => 'অধ্যায় ১: ১ থেকে ১০ গণনা', 'content' => '১ (এক), ২ (দুই), ৩ (তিন), ৪ (চার), ৫ (পাঁচ)।']
                ]
            ],

            // CLASS 2
            [
                'grade' => 'class_2', 'subject_id' => $banglaSub->id, 'author_id' => $nctbAuthor->id,
                'title' => 'আমার বাংলা বই (Class 2)', 'cover_color' => 'from-rose-600 to-pink-700',
                'description' => 'দ্বিতীয় শ্রেণীর শিক্ষার্থীদের আমার বাংলা পাঠ্যবই।',
                'price' => 140, 'discount_price' => 120, 'isbn' => 'NCTB-C2-BAN-2026', 'publisher' => 'NCTB Board',
                'chapters' => [
                    ['chapter_number' => 1, 'title' => 'অধ্যায় ১: আমাদের বাংলাদেশ', 'content' => 'আমাদের দেশের নাম বাংলাদেশ। সবুজ ঘাস ও রূপালী নদী।']
                ]
            ],
            [
                'grade' => 'class_2', 'subject_id' => $englishSub->id, 'author_id' => $nctbAuthor->id,
                'title' => 'English for Today (Class 2)', 'cover_color' => 'from-indigo-600 to-blue-700',
                'description' => 'English for Today Class 2 standard curriculum.',
                'price' => 145, 'discount_price' => 125, 'isbn' => 'NCTB-C2-ENG-2026', 'publisher' => 'NCTB Board',
                'chapters' => [
                    ['chapter_number' => 1, 'title' => 'Unit 1: Days of the Week', 'content' => 'Sunday, Monday, Tuesday, Wednesday, Thursday, Friday, Saturday.']
                ]
            ],
            [
                'grade' => 'class_2', 'subject_id' => $mathSub->id, 'author_id' => $nctbAuthor->id,
                'title' => 'প্রাথমিক গণিত (Class 2)', 'cover_color' => 'from-teal-600 to-emerald-800',
                'description' => 'দ্বিতীয় শ্রেণীর ২ অঙ্কের যোগ-বিয়োগ ও প্রারম্ভিক গণিত।',
                'price' => 150, 'discount_price' => 130, 'isbn' => 'NCTB-C2-MAT-2026', 'publisher' => 'NCTB Board',
                'chapters' => [
                    ['chapter_number' => 1, 'title' => 'অধ্যায় ১: ২ অঙ্কের যোগ-বিয়োগ', 'content' => '১০ + ১৫ = ২৫, ৫০ - ২০ = ৩০।']
                ]
            ],

            // CLASS 3
            [
                'grade' => 'class_3', 'subject_id' => $banglaSub->id, 'author_id' => $nctbAuthor->id,
                'title' => 'আমার বাংলা বই (Class 3)', 'cover_color' => 'from-amber-600 to-yellow-800',
                'description' => 'তৃতীয় শ্রেণীর আমার বাংলা পাঠ্যবই।',
                'price' => 160, 'discount_price' => 140, 'isbn' => 'NCTB-C3-BAN-2026', 'publisher' => 'NCTB Board',
                'chapters' => [
                    ['chapter_number' => 1, 'title' => 'অধ্যায় ১: রাজা ও তিন কন্যা', 'content' => 'এক দেশে ছিল এক প্রজা বৎসল রাজা ও তার তিন কন্যা।']
                ]
            ],
            [
                'grade' => 'class_3', 'subject_id' => $scienceSub->id, 'author_id' => $nctbAuthor->id,
                'title' => 'প্রাথমিক বিজ্ঞান (Class 3)', 'cover_color' => 'from-teal-600 to-green-700',
                'description' => 'তৃতীয় শ্রেণীর জীব ও জড় বস্তু সংক্রান্ত বিজ্ঞান বই।',
                'price' => 155, 'discount_price' => 135, 'isbn' => 'NCTB-C3-SCI-2026', 'publisher' => 'NCTB Board',
                'chapters' => [
                    ['chapter_number' => 1, 'title' => 'অধ্যায় ১: আমাদের পরিবেশের জীব ও জড়', 'content' => 'যাদের প্রাণ আছে তারা জীব এবং যাদের প্রাণ নেই তারা জড়।']
                ]
            ],

            // CLASS 4
            [
                'grade' => 'class_4', 'subject_id' => $mathSub->id, 'author_id' => $nctbAuthor->id,
                'title' => 'প্রাথমিক গণিত (Class 4)', 'cover_color' => 'from-emerald-600 to-cyan-700',
                'description' => '৪র্থ শ্রেণীর গুণ, ভাগ ও স্থানীয় মান শিক্ষা বই।',
                'price' => 170, 'discount_price' => 150, 'isbn' => 'NCTB-C4-MAT-2026', 'publisher' => 'NCTB Board',
                'chapters' => [
                    ['chapter_number' => 1, 'title' => 'অধ্যায় ১: বড় সংখ্যা ও স্থানীয় মান', 'content' => 'একক, দশক, শতক, হাজার, ওযুত, লক্ষ, নিযুত, কোটি।']
                ]
            ],

            // CLASS 5 (PEC)
            [
                'grade' => 'class_5', 'subject_id' => $scienceSub->id, 'author_id' => $nctbAuthor->id,
                'title' => 'প্রাথমিক বিজ্ঞান (Class 5 PEC)', 'cover_color' => 'from-teal-700 to-green-900',
                'description' => '৫ম শ্রেণীর খাদ্য শৃঙ্খল ও পরিবেশ বিজ্ঞান পাঠ্যবই।',
                'price' => 180, 'discount_price' => 160, 'isbn' => 'NCTB-C5-SCI-2026', 'publisher' => 'NCTB Board',
                'chapters' => [
                    ['chapter_number' => 1, 'title' => 'অধ্যায় ১: আমাদের পরিবেশ ও খাদ্য শৃঙ্খল', 'content' => 'উদ্ভিদ সূর্যের আলো ব্যবহার করে সালোকসংশ্লেষণ প্রক্রিয়ায় খাদ্য তৈরি করে।']
                ]
            ],

            // CLASS 6
            [
                'grade' => 'class_6', 'subject_id' => $mathSub->id, 'author_id' => $nctbAuthor->id,
                'title' => 'গণিত (Mathematics Class 6)', 'cover_color' => 'from-emerald-600 to-teal-700',
                'description' => '৬ষ্ঠ শ্রেণীর স্বাভাবিক সংখ্যা, ভগ্নাংশ ও জ্যামিতি পাঠ্যবই।',
                'price' => 200, 'discount_price' => 180, 'isbn' => 'NCTB-C6-MAT-2026', 'publisher' => 'NCTB Board',
                'chapters' => [
                    ['chapter_number' => 1, 'title' => 'অধ্যায় ১: স্বাভাবিক সংখ্যা ও ভগ্নাংশ', 'content' => 'মৌলিক ও যৌগিক সংখ্যা, লসাগু ও গসাগু নির্ণয়।']
                ]
            ],
            [
                'grade' => 'class_6', 'subject_id' => $ictSub->id, 'author_id' => $nctbAuthor->id,
                'title' => 'তথ্য ও যোগাযোগ প্রযুক্তি (ICT Class 6)', 'cover_color' => 'from-violet-600 to-purple-800',
                'description' => '৬ষ্ঠ শ্রেণীর কম্পিউটার পরিচিতি ও আইসিটি শিক্ষা।',
                'price' => 160, 'discount_price' => 140, 'isbn' => 'NCTB-C6-ICT-2026', 'publisher' => 'NCTB Board',
                'chapters' => [
                    ['chapter_number' => 1, 'title' => 'অধ্যায় ১: তথ্য ও যোগাযোগ প্রযুক্তি পরিচিতি', 'content' => 'কম্পিউটার হার্ডওয়্যার, সফটওয়্যার ও ইন্টারনেটের ব্যবহার।']
                ]
            ],

            // CLASS 7
            [
                'grade' => 'class_7', 'subject_id' => $scienceSub->id, 'author_id' => $nctbAuthor->id,
                'title' => 'বিজ্ঞান (Science Class 7)', 'cover_color' => 'from-teal-600 to-emerald-800',
                'description' => '৭ম শ্রেণীর অণুজীব ও রাসায়নিক বিজ্ঞান।',
                'price' => 210, 'discount_price' => 190, 'isbn' => 'NCTB-C7-SCI-2026', 'publisher' => 'NCTB Board',
                'chapters' => [
                    ['chapter_number' => 1, 'title' => 'অধ্যায় ১: নিম্নশ্রেণীর জীব', 'content' => 'ভাইরাস, ব্যাকটেরিয়া, ছত্রাক ও শৈবালের গঠন।']
                ]
            ],

            // CLASS 8 (JSC)
            [
                'grade' => 'class_8', 'subject_id' => $mathSub->id, 'author_id' => $nctbAuthor->id,
                'title' => 'গণিত (Mathematics Class 8 JSC)', 'cover_color' => 'from-emerald-700 to-teal-900',
                'description' => '৮ম শ্রেণীর প্যাটার্ন, মুনাফা ও বীজগণিতীয় সূত্রাবলী।',
                'price' => 230, 'discount_price' => 200, 'isbn' => 'NCTB-C8-MAT-2026', 'publisher' => 'NCTB Board',
                'chapters' => [
                    ['chapter_number' => 1, 'title' => 'অধ্যায় ১: প্যাটার্ন (Pattern)', 'content' => 'জ্যামিতিক ও সংখ্যা প্যাটার্ন গঠন।']
                ]
            ],
            [
                'grade' => 'class_8', 'subject_id' => $ictSub->id, 'author_id' => $nctbAuthor->id,
                'title' => 'তথ্য ও যোগাযোগ প্রযুক্তি (ICT Class 8)', 'cover_color' => 'from-purple-700 to-violet-900',
                'description' => '৮ম শ্রেণীর নেটওয়ার্ক টপোলজি ও সাইবার সিকিউরিটি।',
                'price' => 170, 'discount_price' => 150, 'isbn' => 'NCTB-C8-ICT-2026', 'publisher' => 'NCTB Board',
                'chapters' => [
                    ['chapter_number' => 1, 'title' => 'অধ্যায় ১: নেটওয়ার্ক ও টপোলজি', 'content' => 'Star, Bus, Ring ও Mesh টপোলজি বিশ্লেষণ।']
                ]
            ],

            // CLASS 9-10 (SSC)
            [
                'grade' => 'class_9', 'subject_id' => $physicsSub->id, 'author_id' => $nctbAuthor->id,
                'title' => 'পদার্থবিজ্ঞান (Physics SSC Class 9-10)', 'cover_color' => 'from-indigo-600 to-purple-800',
                'description' => '৯ম ও ১০ম শ্রেণীর এসএসসি পদার্থবিজ্ঞান পাঠ্যবই।',
                'price' => 260, 'discount_price' => 230, 'isbn' => 'NCTB-SSC-PHY-2026', 'publisher' => 'NCTB Board',
                'chapters' => [
                    ['chapter_number' => 1, 'title' => 'অধ্যায় ১: ভৌত রাশি ও পরিমাপ', 'content' => 'ভৌত রাশি, স্লাইড ক্যালিফার্স ও স্ক্রু গজ।'],
                    ['chapter_number' => 2, 'title' => 'অধ্যায় ২: গতি (Motion)', 'content' => 'v = u + at, s = ut + 1/2at^2 গতির সমীকরণ।']
                ]
            ],
            [
                'grade' => 'class_10', 'subject_id' => $chemistrySub->id, 'author_id' => $nctbAuthor->id,
                'title' => 'রসায়ন (Chemistry SSC Class 9-10)', 'cover_color' => 'from-cyan-600 to-teal-800',
                'description' => 'এসএসসি রসায়ন পর্যায় সারণি ও মোলের ধারণা।',
                'price' => 250, 'discount_price' => 220, 'isbn' => 'NCTB-SSC-CHE-2026', 'publisher' => 'NCTB Board',
                'chapters' => [
                    ['chapter_number' => 1, 'title' => 'অধ্যায় ৩: পদার্থের গঠন', 'content' => 'বোর পরমাণু মডেল ও পর্যায় সারণি।']
                ]
            ],
            [
                'grade' => 'class_10', 'subject_id' => $biologySub->id, 'author_id' => $nctbAuthor->id,
                'title' => 'জীববিজ্ঞান (Biology SSC Class 9-10)', 'cover_color' => 'from-green-700 to-emerald-900',
                'description' => 'এসএসসি জীববিজ্ঞান কোষ বিভাজন ও টিস্যু।',
                'price' => 255, 'discount_price' => 225, 'isbn' => 'NCTB-SSC-BIO-2026', 'publisher' => 'NCTB Board',
                'chapters' => [
                    ['chapter_number' => 1, 'title' => 'অধ্যায় ২: জীবকোষ ও টিস্যু', 'content' => 'মাইটোসিস ও মিওসিস কোষ বিভাজন।']
                ]
            ],

            // CLASS 11-12 (HSC)
            [
                'grade' => 'class_11', 'subject_id' => $chemistrySub->id, 'author_id' => $hajariAuthor->id,
                'title' => 'রসায়ন ১ম পত্র (Chemistry 1st Paper HSC)', 'cover_color' => 'from-emerald-700 to-teal-900',
                'description' => 'প্রফেসর মো: হাজারী ও নাগ রচিত উচ্চমাধ্যমিক রসায়ন ১ম পত্র।',
                'price' => 450, 'discount_price' => 390, 'isbn' => '978-984-34-1102-1', 'publisher' => 'হাসান বুক হাউস',
                'chapters' => [
                    ['chapter_number' => 1, 'title' => 'অধ্যায় ২: গুণগত রসায়ন', 'content' => 'কোয়ান্টাম সংখ্যা, অর্বিটাল এবং দ্রাব্যতা গুণফল (Ksp)।']
                ]
            ],
            [
                'grade' => 'class_11', 'subject_id' => $physicsSub->id, 'author_id' => $tapanAuthor->id,
                'title' => 'পদার্থবিজ্ঞান ১ম পত্র (Physics 1st Paper HSC)', 'cover_color' => 'from-indigo-700 to-blue-900',
                'description' => 'ড. শাহজাহান তপন রচিত এইচএসসি পদার্থবিজ্ঞান ১ম পত্র।',
                'price' => 480, 'discount_price' => 420, 'isbn' => '978-984-34-2201-4', 'publisher' => 'অক্ষরপত্র প্রকাশনী',
                'chapters' => [
                    ['chapter_number' => 1, 'title' => 'অধ্যায় ২: ভেক্টর (Vector)', 'content' => 'সামান্তরিকের সূত্র, ডট গুণন ও ক্রস গুণন।']
                ]
            ],
            [
                'grade' => 'class_11', 'subject_id' => $higherMathSub->id, 'author_id' => $ketabAuthor->id,
                'title' => 'উচ্চতর গণিত ১ম পত্র (Higher Math 1st Paper HSC)', 'cover_color' => 'from-blue-700 to-indigo-900',
                'description' => 'কেতাব উদ্দীন আহমেদ রচিত এইচএসসি উচ্চতর গণিত ১ম পত্র।',
                'price' => 520, 'discount_price' => 460, 'isbn' => '978-984-34-3305-9', 'publisher' => 'সিস্টেক পাবলিকেশন্স',
                'chapters' => [
                    ['chapter_number' => 1, 'title' => 'অধ্যায় ১: ম্যাট্রিক্স ও নির্ণায়ক', 'content' => 'ম্যাট্রিক্সের গুণন, ইনভার্স ম্যাট্রিক্স ও ক্রেমারের নিয়ম।']
                ]
            ],
            [
                'grade' => 'class_12', 'subject_id' => $ictSub->id, 'author_id' => $mujiburAuthor->id,
                'title' => 'তথ্য ও যোগাযোগ প্রযুক্তি (ICT Class 11-12 HSC)', 'cover_color' => 'from-purple-700 to-pink-900',
                'description' => 'প্রকৌশলী মুজিবুর রহমান রচিত এইচএসসি তথ্য ও যোগাযোগ প্রযুক্তি।',
                'price' => 380, 'discount_price' => 330, 'isbn' => '978-984-34-4408-2', 'publisher' => 'প্রকাশক পাবলিকেশন্স',
                'chapters' => [
                    ['chapter_number' => 1, 'title' => 'অধ্যায় ৩: সংখ্যা পদ্ধতি ও লজিক গেট', 'content' => 'বাইনারি, হেক্সাডেসিমেল ও লজিক গেট (NAND/NOR)।']
                ]
            ],
        ];

        foreach ($booksList as $b) {
            $grade = GradeLevel::where('code', $b['grade'])->first();
            if (!$grade) continue;

            $book = Book::updateOrCreate(
                ['title' => $b['title']],
                [
                    'grade_level_id' => $grade->id,
                    'subject_id' => $b['subject_id'],
                    'author_id' => $b['author_id'],
                    'slug' => Str::slug($b['title']),
                    'cover_color' => $b['cover_color'],
                    'description' => $b['description'],
                    'price' => $b['price'],
                    'discount_price' => $b['discount_price'],
                    'isbn' => $b['isbn'],
                    'publisher' => $b['publisher'],
                    'stock_status' => 'in_stock',
                    'is_featured' => true,
                    'page_count' => rand(100, 450),
                    'rating' => 4.90,
                    'reader_count' => rand(12000, 85000),
                    'published_date' => now()->subMonths(rand(1, 12)),
                ]
            );

            if (isset($b['chapters'])) {
                foreach ($b['chapters'] as $chap) {
                    Chapter::updateOrCreate(
                        ['book_id' => $book->id, 'chapter_number' => $chap['chapter_number']],
                        [
                            'title' => $chap['title'],
                            'content' => $chap['content'],
                        ]
                    );
                }
            }
        }
    }
}
