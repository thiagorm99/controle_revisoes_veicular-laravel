<?php

namespace App\Http\Controllers;

use App\Models\Proprietario;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ProprietarioController extends Controller
{
    public function proprietarios_api()
    {
        $data['proprietarios'] = Proprietario::all()->sortBy('id');

        $json = [];

        foreach ($data['proprietarios'] as $key => $value) {
            $json["data"][] = [
                "id" => $value->id,
                "nome" => $value->nome,
                "endereco" => $value->endereco,
                "telefone" => $value->telefone,
                "sexo" => config('constants.sexos')[$value->sexo],
                "data_nascimento" => date('d-m-Y', strtotime($value->data_nascimento)),
                "acoes" => $value->id,
            ];
        }

        return json_encode($json);
    }

    public function proprietarios()
    {
        return view('proprietarios.proprietarios');
    }

    public function editar_frm($id)
    {
        $data['proprietario'] = Proprietario::find($id);
        $data['sexos'] = config('constants.sexos');
        return $data['proprietario'];
    }

    public function salvar(Request $request)
    {

        $mensagens = [
            'nome.required' => 'O campo nome é obrigatório.',
            'nome.min' => 'O campo nome deve ter pelo menos :min caracteres.',
            'nome.max' => 'O campo nome não deve ter mais de :max caracteres.',

            'endereco.required' => 'O campo endereço é obrigatório.',
            'endereco.min' => 'O campo endereço deve ter pelo menos :min caracteres.',
            'endereco.max' => 'O campo endereço não deve ter mais de :max caracteres.',

            'telefone.required' => 'O campo telefone é obrigatório.',
            'telefone.digits' => 'O campo telefone deve ter :digits caracteres.',

            'sexo.required' => 'O campo sexo é obrigatório.',
            'sexo.digits' => 'O campo sexo deve ter :max caracteres.',

            'data_nascimento.required' => 'O campo data de nascimento é obrigatório.',
            'data_nascimento.date' => 'O campo data deve ser digitado corretamente.'
        ];


        $validate = $request->validate([
            'nome' => 'required|min:5|max:50',
            'endereco' => 'required|min:10|max:50',
            'telefone' => 'required|max:15',
            'sexo' => 'required|max:1',
            'data_nascimento' => 'required|date',
        ], $mensagens);

        $proprietario = new Proprietario();
        $proprietario->nome = $request->input('nome');
        $proprietario->endereco = $request->input('endereco');
        $proprietario->telefone = $request->input('telefone');
        $proprietario->sexo = $request->input('sexo');
        $proprietario->data_nascimento = $request->input('data_nascimento');

        // tratar se teve éxito e enviar erros
        try {
            $proprietario->save();
            return "Cadastrado";
        } catch (\Throwable $th) {
            return $th->getMessage();
        }


    }

    public function editar(Request $request)
    {

        $mensagens = [
            'nome.required' => 'O campo nome é obrigatório.',
            'nome.min' => 'O campo nome deve ter pelo menos :min caracteres.',
            'nome.max' => 'O campo nome não deve ter mais de :max caracteres.',

            'endereco.required' => 'O campo endereço é obrigatório.',
            'endereco.min' => 'O campo endereço deve ter pelo menos :min caracteres.',
            'endereco.max' => 'O campo endereço não deve ter mais de :max caracteres.',

            'telefone.required' => 'O campo telefone é obrigatório.',
            'telefone.digits' => 'O campo telefone deve ter :digits caracteres.',

            'sexo.required' => 'O campo sexo é obrigatório.',
            'sexo.digits' => 'O campo sexo deve ter :max caracteres.',

            'data_nascimento.required' => 'O campo data de nascimento é obrigatório.',
            'data_nascimento.date' => 'O campo data deve ser digitado corretamente.'
        ];


        $validate = $request->validate([
            'nome' => 'required|min:5|max:50',
            'endereco' => 'required|min:10|max:50',
            'telefone' => 'required|max:15',
            'sexo' => 'required|max:1',
            'data_nascimento' => 'required|date',
        ], $mensagens);

        $proprietario = Proprietario::find($request->input('id'));
        $proprietario->nome = $request->input('nome');
        $proprietario->endereco = $request->input('endereco');
        $proprietario->telefone = $request->input('telefone');
        $proprietario->sexo = $request->input('sexo');
        $proprietario->data_nascimento = $request->input('data_nascimento');

        // tratar de teve éxito e enviar erros
        try {
            $proprietario->save();
            return "Editado";
        } catch (\Throwable $th) {
            return $th->getMessage();
        }

    }

    public function deletar(Request $request)
    {
        $proprietario = Proprietario::find($request->id_pd);

        // tratar de teve éxito e enviar erros
        try {
            $proprietario->delete();
            return "Deletado";
        } catch (\Throwable $th) {
            return "Não foi possível deletar - esse registro tem restrições";
        }

    }
}
