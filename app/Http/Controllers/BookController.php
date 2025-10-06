<?php

namespace App\Http\Controllers;

use App\Models\Book;use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $books = Book::all(); // Fetch all books
        return view('books.index', compact('books')); // Return the view with books
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('books.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         // Validate input
        $request->validate([
            'title' => 'required',
            'description' => 'required|max:500',
            'year' => 'required|integer',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Check if the image is uploaded and handle it
        if ($request->hasFile('image')) {
          
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('images/books'), $imageName);

        }



        // Create a book record in the database
        Book::create([
            'title' => $request->title,
            'description' => $request->description, 
            'year' => $request->year,
            'image' => $imageName, // Store the image name in the DB, not the image file itself
            'created_at' => now(),
            'updated_at' => now()
        ]);

        // Redirect to the index page with a success message
        return to_route('books.index')->with('success', 'Book created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        return view('books.show', compact('book')); // Return the view with the specific book
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Book $book)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        //
    }
}
