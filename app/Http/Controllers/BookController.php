<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use App\Http\Requests\BookRequest;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // public static function middleware(): array
    // {
    //     return [
    //         // examples with aliases, pipe-separated names, guards, etc:
    //         'role_or_permission:manager|edit articles',
    //         new Middleware('role:admin', only: ['index','show','edit','delete','create']),
    //         new Middleware('role:regular_user', only: ['index','show']),
    //     ];
    // }
    public function index()
    {
        $books=Book::orderBy('title')->paginate(10);
        $count=count($books);
        return view('books.index',compact('books','count'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (! Gate::allows('create-book')) {
            abort(403);
        }
        return view('books.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BookRequest $validatedData)
    {
        $book=Book::create([
            'title' => $validatedData['title'],
            'authour' => $validatedData['authour'],
            'availability_status' => $validatedData['availability_status'],
        ]);
        $book->save();
        session()->flash('message', 'Book Added Successfully');
        return redirect('/books');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $book=Book::find($id);
        return view('books.show',compact('book'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $book=new Book();
        if (! Gate::allows('update-book')) {
            abort(403);
        }
        return view('books.edit', compact('book'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BookRequest $validatedData, string $id)
    {
        // Gate::authorize('update');
        $book=Book::find($id);
        $book->update([
            'title' => $validatedData['title'],
            'authour' => $validatedData['authour'],
            'availability_status' => $validatedData['availability_status'],
        ]);
        $book->save();
        session()->flash('message', 'Book Updated Successfully');
        return redirect('/books');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $book=new Book();
        if (! Gate::allows('delete-book')) {
            abort(403);
        }        $book=Book::find($id);
        $book->delete();
        session()->flash('message', 'Book Deleted Successfully');
        return redirect('/books');
    }

    public function search(Request $request)
    {
        // Retrieve the search input from the query string
        $searchTerm = $request->input('search');

        // Query the database for books matching the search term (assuming you're searching by title)
        $books = Book::where('title', 'like', '%' . $searchTerm . '%')->get();
        $count=count($books);
        
        // Return the search results to a view
        return view('books.index', compact('books','count'));
    }
    // public function check()
    // {
    //     return 'ok';
    // }
    public function generatePDF()
    {
        // Data to pass to the view
        $books = Book::all();

        // Load the Blade view and pass data
        $pdf = FacadePdf::loadView('pdf.sample', ['books' => $books]);

        // Return the generated PDF as a response
        return $pdf->download('sample.pdf');
    }
}
