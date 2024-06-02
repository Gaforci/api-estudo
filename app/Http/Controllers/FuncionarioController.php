<?php

namespace App\Http\Controllers;

use App\Models\Funcionario;
use Exception;
use Illuminate\Http\Request;

class FuncionarioController extends Controller
{
    public function index()
    {
        return response()->json(['ret' => 1, 'data' => Funcionario::all()]);
    }

    public function store(Request $request)
    {
        try{
            $request->validate([
                'user_id' => 'required|integer|numeric',
                'setor' => 'required|string',
                'funcao' => 'required|string',
                'data_admissao' => 'required|date'
            ]);

            $data = $request->only([
                'user_id',
                'setor',
                'funcao',
                'data_admissao'
            ]);

            $funcionario = Funcionario::create($data);

            return response()->json(['ret' => 1, 'data' => $funcionario]);
        } catch(Exception $e) {
            return response()->json(['ret' => 0, 'msg' => $e->getMessage()]);
        }

    }

    public function show(Funcionario $funcionario)
    {
        return response()->json(['ret' => 1, 'data' => $funcionario->load('user')]);
    }

    public function update(Request $request, Funcionario $funcionario)
    {
        try {
            $request->validate([
                'user_id' => 'required|integer|numeric',
                'setor' => 'required|string',
                'funcao' => 'required|string',
                'data_admissao' => 'required|date'
            ]);

            $funcionario->update($request->all());
            return response()->json(['ret' => 1, 'data' => $funcionario]);
        } catch(Exception $e) {
            return response()->json(['ret' => 0, 'msg' => $e->getMessage()]);
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Funcionario $funcionario)
    {
        $funcionario->delete();
        return response()->json(['ret' => 1, 'msg' => 'Usuário deletado']); 
    }
}
