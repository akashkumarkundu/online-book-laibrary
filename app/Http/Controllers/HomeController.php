<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Book;
use App\Models\GradeLevel;
use App\Models\Subject;
use Illuminate\Contracts\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $featuredBooks = Book::with(['gradeLevel', 'subject', 'author'])
            ->where('is_featured', true)
            ->latest()
            ->take(8)
            ->get();

        $gradeLevels = GradeLevel::orderBy('sort_order')->get();
        $subjects = Subject::all();
        $authors = Author::take(6)->get();

        $totalBooksCount = Book::count();
        $totalReadersCount = (int) Book::sum('reader_count');

        return view('pages.home', compact(
            'featuredBooks',
            'gradeLevels',
            'subjects',
            'authors',
            'totalBooksCount',
            'totalReadersCount'
        ));
    }
}
