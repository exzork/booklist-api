<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateBook;
use App\Http\Requests\UpdateBook;
use App\Http\Resources\BookResource;
use App\Models\Book;
use App\Traits\ApiResponse;

class BookController extends Controller
{
    use ApiResponse;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $books = Book::all();
        return $this->success(['books'=>BookResource::collection($books)],200,'Books retrieved successfully');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\CreateBook $createBook
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CreateBook $createBook)
    {
        $book = Book::create($createBook->validated());
        return $this->success(['book'=>new BookResource($book)],201,'Book created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Book $book)
    {
        if($book){
            return $this->success(['book'=>new BookResource($book)],200,'Book retrieved successfully');
        }else{
            return $this->error(null,'Book not found',404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateBook $updateBook
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateBook $updateBook, Book $book)
    {
        $book->update($updateBook->validated());
        return $this->success(['book'=>new BookResource($book)],200,'Book updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Book $book)
    {
        $book->delete();
        return $this->success(null,204,'Book deleted successfully');
    }
}
