<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Author;
use App\Models\Book;
use App\Models\GradeLevel;
use App\Models\Subject;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BookController extends Controller
{
    public function index(Request $request): View
    {
        $query = Book::with(['gradeLevel', 'subject', 'author']);

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where('title', 'like', "%{$search}%")
                ->orWhere('publisher', 'like', "%{$search}%");
        }

        if ($request->filled('grade_level_id')) {
            $query->where('grade_level_id', $request->input('grade_level_id'));
        }

        $books = $query->latest()->paginate(10)->withQueryString();
        $gradeLevels = GradeLevel::orderBy('sort_order')->get();

        return view('admin.books.index', compact('books', 'gradeLevels'));
    }

    public function create(): View
    {
        $gradeLevels = GradeLevel::orderBy('sort_order')->get();
        $subjects = Subject::all();
        $authors = Author::all();

        return view('admin.books.create', compact('gradeLevels', 'subjects', 'authors'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'grade_level_id' => 'required|exists:grade_levels,id',
            'subject_id' => 'required|exists:subjects,id',
            'author_id' => 'required|exists:authors,id',
            'price' => 'required|numeric|min:0',
            'discount_price' => 'nullable|numeric|min:0',
            'publisher' => 'required|string|max:255',
            'isbn' => 'nullable|string|max:50',
            'page_count' => 'required|integer|min:1',
            'cover_color' => 'required|string',
            'stock_status' => 'required|in:in_stock,out_of_stock',
            'is_featured' => 'boolean',
            'description' => 'required|string',
        ]);

        $validated['slug'] = Str::slug($validated['title']).'-'.rand(100, 999);
        $validated['is_featured'] = $request->has('is_featured');
        $validated['rating'] = 4.8;
        $validated['reader_count'] = 0;
        $validated['published_date'] = now()->toDateString();

        Book::create($validated);

        return redirect()->route('admin.books.index')->with('success', 'নতুন বই সফলভাবে সংযুক্ত করা হয়েছে!');
    }

    public function edit(Book $book): View
    {
        $gradeLevels = GradeLevel::orderBy('sort_order')->get();
        $subjects = Subject::all();
        $authors = Author::all();

        return view('admin.books.edit', compact('book', 'gradeLevels', 'subjects', 'authors'));
    }

    public function update(Request $request, Book $book): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'grade_level_id' => 'required|exists:grade_levels,id',
            'subject_id' => 'required|exists:subjects,id',
            'author_id' => 'required|exists:authors,id',
            'price' => 'required|numeric|min:0',
            'discount_price' => 'nullable|numeric|min:0',
            'publisher' => 'required|string|max:255',
            'isbn' => 'nullable|string|max:50',
            'page_count' => 'required|integer|min:1',
            'cover_color' => 'required|string',
            'stock_status' => 'required|in:in_stock,out_of_stock',
            'is_featured' => 'boolean',
            'description' => 'required|string',
        ]);

        $validated['is_featured'] = $request->has('is_featured');

        $book->update($validated);

        return redirect()->route('admin.books.index')->with('success', 'বইটির তথ্য সফলভাবে আপডেট করা হয়েছে!');
    }

    public function destroy(Book $book): RedirectResponse
    {
        $book->delete();

        return redirect()->route('admin.books.index')->with('success', 'বইটি তালিকা থেকে মুছে ফেলা হয়েছে!');
    }
}
