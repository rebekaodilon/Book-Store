<?php

namespace App\Http\Controllers\Api;

use App\Models\Book;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use App\Services\BookService;

class BookController extends Controller
{

    public function __construct(BookService $bookService)
    {
        $this->bookService = $bookService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books = $this->bookService->getBooks();

        if ($books) 
        {
            return $books;
        }

        return response()->json(['message' => 'No books found, register some'], 404);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request = $request->all();

        $createdBook = $this->bookService->store($request);

        if ($createdBook) 
        {
            return $createdBook;
        }
        
        return response()->json(['message' => 'The book already exists!'], 403);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $book = $this->bookService->show($id);

        if ($book) 
        {
            return $book;
        }

        return response()->json(['message' => 'Book not found'], 404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request = $request->all();

        $updatedBook = $this->bookService->update($id, $request);

        if ($updatedBook)
        {
            return response()->json(['message' => 'Book updated successfuly'], 200);
        }

        return response()->json(['message' => 'Book not found'], 404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $book = $this->bookService->delete($id);

        if ($book) {
            return response()->noContent();
        }

        return response()->json(['message' => 'Book not found'], 404);
    }
}
