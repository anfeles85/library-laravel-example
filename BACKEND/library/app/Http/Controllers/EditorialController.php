<?php

namespace App\Http\Controllers;

use App\Models\Editorial;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class EditorialController extends Controller
{
    private $rules = [
        'name' => 'required|string|max:50|min:3',
    ];

    private $traductionAttributes = [
        'name' => 'nombre',
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
        $editorials = Editorial::all();
        return response()->json($editorials, Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $this->applyValidator($request);
        if (!empty($data)) {
            return $data;
        }

        $editorial = Editorial::create($request->all());
        $response = [
            'message' => 'Registro creado exitosamente',
            'editorial'  => $editorial
        ];

        return response()->json($response, Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(Editorial $editorial)
    {
        return response()->json($editorial, Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Editorial $editorial)
    {
        $data = $this->applyValidator($request);
        if (!empty($data)) {
            return $data;
        }

        $editorial->update($request->all());
        $data = [
            'message' => 'Registro actualizado exitosamente',
            'editorial'  => $editorial
        ];

        return response()->json($data, Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Editorial $editorial)
    {
        $editorial->delete();
        $data = [
            'message' => 'Registro eliminado exitosamente',
            'editorial'  => $editorial->id
        ];

        return response()->json($data, Response::HTTP_OK);
    }
}
