<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class EditorialController extends Controller
{
    private $path = "/editorial";
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $url = env('URL_BASE_API', 'http://localhost:8000/api');
        $response = Http::acceptJson()->withToken(Session::get('token'))->get($url . $this->path);

        if ($response->successful())
        {
            $editorials = $response->json();
            return view('editorial.index', compact('editorials'));
        }
        elseif ($response->status() === Response::HTTP_BAD_REQUEST) {            
            $errors = $response->json()['errors'];
            return redirect()->route('editorial.index')
                ->with('messageModal', 'Error||Algunos campos tienen errores||error')
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
        return view('editorial.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $url = env('URL_BASE_API', 'http://localhost:8000/api');
        $response = Http::acceptJson()->withToken(Session::get('token'))->post($url . $this->path, [
            'id'    =>  $request->id,
            'name'    =>  $request->name,
            'description'    =>  $request->type,
        ]);
        
        if ($response->successful())
        {
            return redirect()->route('editorial.index')
                ->with('messageModal', 'Completado||Registro creado correctamente||success');
        }
        elseif ($response->status() === Response::HTTP_BAD_REQUEST) {            
            $errors = $response->json()['errors'];
            return redirect()->route('editorial.create')
                ->with('messageModal', 'Error||Algunos campos tienen errores||error')
                ->withInput()->withErrors($errors);
        }
        else 
        {
            abort($response->status());
        }  
    }
    

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $url = env('URL_BASE_API', 'http://localhost:8000/api');
        $response = Http::acceptJson()->withToken(Session::get('token'))->get($url . $this->path . '/' . $id);
        
        if ($response->successful())
        {
            $editorial = $response->json();
            return view('editorial.edit', compact('editorial'));
        }
        elseif ($response->status() === Response::HTTP_BAD_REQUEST) {
            
            $errors = $response->json()['errors'];
            return redirect()->route('editorial.edit')
                ->with('messageModal', 'Error||Algunos campos tienen errores||error')
                ->withInput()->withErrors($errors);
        }
        else 
        {
            abort($response->status());
        }     
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $url = env('URL_BASE_API', 'http://localhost:8000/api');
        $response = Http::withToken(Session::get('token'))->put($url . $this->path . '/' . $id, [
            'id'    =>  $request->id,
            'name'    =>  $request->name,
            'type'    =>  $request->type,
        ]);

        if ($response->successful())
        {
            return redirect()->route('editorial.index')
                ->with('messageModal', 'Completado||Registro actualizado correctamente||success');
        }
        elseif ($response->status() === Response::HTTP_BAD_REQUEST) {
            
            $errors = $response->json()['errors'];
            return redirect()->route('editorial.edit', $id)
                ->with('messageModal', 'Error||Algunos campos tienen errores||error')
                ->withInput()->withErrors($errors);
        }
        else 
        {
            abort($response->status());
        }    
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $url = env('URL_BASE_API', 'http://localhost:8000/api');
        $response = Http::acceptJson()->delete($url . $this->path . '/' . $id);

        if($response->successful())
        {
            return redirect()->route('editorial.index')
                ->with('messageModal', 'Completado||Registro eliminado correctamente||success');
        }
        elseif($response->status() === Response::HTTP_BAD_REQUEST) {
            $errors = $response->json()['errors'];
            return redirect()->route('editorial.index')
                ->with('messageModal', 'Error||Algunos campos tienen errores||error')
                ->withInput()->withErrors($errors);            
        }
        elseif($response->status() === Response::HTTP_NOT_FOUND) {
            session()->flash('warning', 'Registro no encontrado');
            return redirect()->route('editorial.index')
                ->with('messageModal', '¡Ojo!||Registro no encontrado||warning');
        }
        else{
            abort($response->status());
        }   

    }
}
