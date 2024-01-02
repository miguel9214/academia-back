<?php

namespace App\Http\Controllers;


use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Student::all();
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

        // Validar los datos de la solicitud
        $request->validate([
            'name' => 'required|string',
            'last_name' => 'required|string',
            'photo' => 'required|string', // Ejemplo de validación de imagen
        ]);

        $student = Student::create([
            'name' => $request->input('name'),
            'last_name' => $request->input('last_name'),
            'photo' => $request->input('photo'),
        ]);

        // Devolver una respuesta JSON
        return response()->json(['message' => 'Student created successfully', 'data' => $student], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $student = Student::find($id);

        if(isset($student)){
            return response()->json(['message' => 'Student found', 'data' => $student], 201);
        }else{
            return response()->json(['message' => 'Student no found', ], 404);
        }
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
        $request->validate([
            'name' => 'required|string',
            'last_name' => 'required|string',
            'photo' => 'required|string',
        ]);

        $student = Student::findOrFail($id);
        // Actualizar los campos del estudiante

        if (!$student) {
            return response()->json(['message' => 'Student no found', 'error' => true], 404);
        } else {
            $student->update([
                'name' => $request->input('name'),
                'last_name' => $request->input('last_name'),
                'photo' => $request->input('photo'),
                // Puedes actualizar más campos según tus necesidades
            ]);

            return response()->json(['message' => 'Student update successfully', 'data' => $student], 201);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
