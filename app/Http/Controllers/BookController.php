<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Book;
use App\Models\GradeLevel;
use App\Models\Subject;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index(Request $request)
    {
        $query = Book::with(['gradeLevel', 'subject', 'author']);

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%")
                  ->orWhere('isbn', 'like', "%{$search}%");
            });
        }

        if ($request->filled('class')) {
            $query->whereHas('gradeLevel', function ($q) use ($request) {
                $q->where('code', $request->class)->orWhere('slug', $request->class);
            });
        }

        if ($request->filled('subject')) {
            $query->whereHas('subject', function ($q) use ($request) {
                $q->where('code', $request->subject)->orWhere('slug', $request->subject);
            });
        }

        if ($request->filled('author')) {
            $query->whereHas('author', function ($q) use ($request) {
                $q->where('slug', $request->author);
            });
        }

        if ($request->filled('sort')) {
            switch ($request->sort) {
                case 'price_low':
                    $query->orderBy('price', 'asc');
                    break;
                case 'price_high':
                    $query->orderBy('price', 'desc');
                    break;
                case 'rating':
                    $query->orderBy('rating', 'desc');
                    break;
                default:
                    $query->latest();
            }
        } else {
            $query->latest();
        }

        $books = $query->paginate(12)->withQueryString();
        $gradeLevels = GradeLevel::orderBy('sort_order')->get();
        $subjects = Subject::all();
        $authors = Author::all();

        return view('pages.books.index', compact('books', 'gradeLevels', 'subjects', 'authors'));
    }

    public function show($id)
    {
        $book = Book::with(['gradeLevel', 'subject', 'author', 'chapters'])->findOrFail($id);
        $relatedBooks = Book::where('grade_level_id', $book->grade_level_id)
            ->where('id', '!=', $book->id)
            ->take(4)
            ->get();

        return view('pages.books.show', compact('book', 'relatedBooks'));
    }

    public function read($id)
    {
        $book = Book::with(['gradeLevel', 'subject', 'author', 'chapters'])->findOrFail($id);
        
        // Increment reader count
        $book->increment('reader_count');

        return view('pages.books.read', compact('book'));
    }
}
