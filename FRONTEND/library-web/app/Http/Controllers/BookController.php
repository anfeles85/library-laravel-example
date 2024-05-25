<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Http;

class BookController extends Controller
{
    private $path = "/book";

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $url = env('URL_BASE_API', 'http://localhost:8000/api');
        $response = Http::acceptJson()->get($url . $this->path);

        if ($response->successful())
        {
            $books = $response->json();
            return view('book.index', compact('books'));
        }
        elseif ($response->status() === Response::HTTP_BAD_REQUEST) {            
            $errors = $response->json()['errors'];            
            return redirect()->route('book.index')                
                    ->withInput()->withErrors($errors);
        }
        else 
        {
            abort($response->status());
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
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
