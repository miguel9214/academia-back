<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Symfony\Component\Console\Input\Input;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Course::all();
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
        $request->validate([
            'name' => 'required|string',
            'number_hours' => 'required|numeric',
        ]);


        $course = Course::created([
            'name' => $request->input('name'),
            'number_hours' => $request->input('number_hours'),
        ]);

        if ($course) {

            response()->json(['message', 'Course created successfully']);
        } else {
            response()->json(['message', 'Course not created']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $course=Course::find($id);

        if($course){
            response()->json(['message','Course found','data'=>$course]);
        }else{
            response()->json(['message','Course not found']);
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
