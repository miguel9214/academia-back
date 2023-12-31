<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return User::all();
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
        $request->validate(
            [
                'name' => 'required|string',
                'last_name' => 'required|string',
                'email' => 'required|email',
                'password' => 'required|string',
            ]
        );

        $user = User::create(
            [
                'name' => $request->input('name'),
                'last_name' => $request->input('last_name'),
                'email' => $request->input('email'),
                'password' => Hash::make($request->input('passowrd')),

            ]
        );

        if (isset($user)) {
            return response()->json(['message' => 'User created successfully', 'data' => $user]);
        } else {
            return response()->json(['message' => 'User not created']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::find($id);

        if ($user) {
            return response()->json(['message' => 'User found', 'data' => $user]);
        } else {
            return response()->json(['message' => 'User not found']);
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
        $request->validate(
            [
                'name' => 'required|string',
                'last_name' => 'required|string',
                'email' => 'required|email',
                'password' => 'required|string',
            ]
        );

        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'User not found']);
        } else {

            $user->update(
                [
                    'name' => $request->input('name'),
                    'last_name' => $request->input('last_name'),
                    'email' => $request->input('email'),
                    'password' => Hash::make($request->input('passowrd')),

                ]
            );
            return response()->json(['message' => 'User update successfully', 'data' => $user]);


        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::find($id);

        if(!$user){
            return response()->json(['message' => 'User not found']);
        }else{
            $user->delete();
            return response()->json(['message' => 'User delate successfully', 'data' => $user]);
        }
    }
}
