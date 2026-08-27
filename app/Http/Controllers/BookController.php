<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Book;
use App\Models\GradeLevel;
use App\Models\Subject;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index(Request $request): View
    {
        $query = Book::with(['gradeLevel', 'subject', 'author']);

        if ($request->filled('search')) {
            $search = (string) $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%")
                    ->orWhere('isbn', 'like', "%{$search}%");
            });
        }

        if ($request->filled('class')) {
            $classVal = (string) $request->class;
            $query->whereHas('gradeLevel', function ($q) use ($classVal) {
                $q->where('code', $classVal)->orWhere('slug', $classVal);
            });
        }

        if ($request->filled('subject')) {
            $subVal = (string) $request->subject;
            $query->whereHas('subject', function ($q) use ($subVal) {
                $q->where('code', $subVal)->orWhere('slug', $subVal);
            });
        }

        if ($request->filled('author')) {
            $authorVal = (string) $request->author;
            $query->whereHas('author', function ($q) use ($authorVal) {
                $q->where('slug', $authorVal);
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

    public function show(int|string $id): View
    {
        /** @var Book $book */
        $book = Book::with(['gradeLevel', 'subject', 'author', 'chapters'])->findOrFail($id);
        $relatedBooks = Book::where('grade_level_id', $book->grade_level_id)
            ->where('id', '!=', $book->id)
            ->take(4)
            ->get();

        return view('pages.books.show', compact('book', 'relatedBooks'));
    }

    public function read(int|string $id): View
    {
        /** @var Book $book */
        $book = Book::with(['gradeLevel', 'subject', 'author', 'chapters'])->findOrFail($id);
        $book->increment('reader_count');

        return view('pages.books.read', compact('book'));
    }
}
