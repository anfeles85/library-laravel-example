<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class BookController extends Controller
{
    private $rules = [
        'isbn' => 'required|string|max:50|min:3',
        'title' => 'required|string|max:50|min:3',
        'author' => 'required|string|max:50|min:3',
        'editorial_id' => 'required|numeric|max:99999999999999999999',
        'category_id' => 'required|numeric|max:99999999999999999999',
    ];

    private $traductionAttributes = [
        'isbn' => 'ISBN',
        'title' => 'título',
        'author' => 'autor',
        'editorial_id' => 'editorial',
        'category_id' => 'categoría',
    ];

    public function applyValidator(Request $request)
    {
        $validator = Validator::make($request->all(), $this->rules);
        $validator->setAttributeNames($this->traductionAttributes);
        $data = [];
        if ($validator->fails()) {
            $data = response()->json([                
                'errors' => $validator->errors(),
                'data' => $request->all()
            ],  Response::HTTP_BAD_REQUEST);
        }

        return $data;
    }
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = Book::all();
        $books->load(['category', 'editorial']);
        return response()->json($books, Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        $book->load(['category', 'editorial']);
        return response()->json($book, Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
