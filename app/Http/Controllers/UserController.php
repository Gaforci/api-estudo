<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(['ret' => 1, 'data' => User::all()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try{
            $request->validate([
                'name' => 'required|string',
                'email' => 'required|string',
                'password' => 'required|string'
            ]);

            $data = $request->only([
                'name',
                'email',
                'password'
            ]);

            $user = User::create($data);

            return response()->json(['ret' => 1, 'data' => $user]);
        } catch(Exception $e) {
            return response()->json(['ret' => 0, 'msg' => $e->getMessage()]);
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // return response()->json(['ret' => 1, 'data' => User::whereId($id)->first()]);
        // return response()->json(['ret' => 1, 'data' => User::whereId($id)->get()]);
        return response()->json(['ret' => 1, 'data' => User::getFuncionario($id)]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $request->validate([
                'name' => 'required|string',
                'email' => 'required|string'
            ]);

            User::find($id)->update($request->all());
            $user = User::find($id);
            return response()->json(['ret' => 1, 'data' => $user]);
        } catch(Exception $e) {
            return response()->json(['ret' => 0, 'msg' => $e->getMessage()]);
        }

    }
    public function destroy(string $id)
    {
        User::whereId($id)->delete();
        return response()->json(['ret' => 1, 'msg' => 'Usuário deletado']);
    }
}