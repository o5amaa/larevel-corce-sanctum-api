<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\BookRequest;
use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Http\Resources\BookResource;
use App\Http\Resources\BooksResource;
use App\Models\Book;

class BookController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:sanctum')->except('index', 'show');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return BooksResource::collection(Book::with('user')->get());
        // return BooksResource::collection(Book::paginate(10));
        // return response()->json(Book::get());
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreBookRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBookRequest $request)
    {
        $book = Book::create([
            'name' => $request->name,
            'body' => $request->body,
            'user_id' => auth()->id(),
        ]);
        // $request->user()->tokens()->delete();
        // $book =  auth()->user()->books()->create($request->validated());

        return new BookResource($book);

        // return response()->json([
        //     'message' => 'Book added'
        // ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        return new BookResource($book);
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateBookRequest  $request
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(StoreBookRequest $request, Book $book)
    {

        $this->authorize('update',$book);

        // $updatedbook= tap($book)->update($request->validated());
        // dd($updatedbook);
        return new BookResource(tap($book)->update($request->validated()));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        $this->authorize('delete',$book);

        $book->delete();

        return response()->json(['message'=> 'Book Deleted'],200);
    }
}
