<?php

namespace App\Http\Controllers;

use App\Models\Revisao;
use App\Models\Veiculo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class RevisoesController extends Controller
{
    // consultar revisões
    public function revisoes_api($id_proprietario)
    {
        $data['revisoes'] = DB::table('revisoes as r')
            ->join('veiculos as v', 'v.id', '=', 'r.id_veiculo')
            ->join('proprietarios as p', 'p.id', '=', 'v.id_proprietario')
            ->select('r.id', 'r.data', 'r.km', 'r.tipo_revisao', 'r.custo', 'v.marca', 'v.modelo', 'v.ano', 'v.placa', 'p.nome')
            ->where('v.id_proprietario', '=', $id_proprietario)
            ->get();


        $json = [];

        if (!count($data['revisoes']) >= 1) {
            return json_encode(null);
        }

        foreach ($data['revisoes'] as $key => $value) {
            $json["data"][] = [
                "id" => $value->id,
                "data" =>  date('d-m-Y', strtotime($value->data)),
                "km" => $value->km,
                "tipo_revisao" => $value->tipo_revisao,
                "custo" => $value->custo,
                "marca" => $value->marca,
                "modelo" => $value->modelo,
                "ano" => $value->ano,
                "placa" => $value->placa,
                "nome" => $value->nome,
                "acoes" => $value->id,
            ];
        }

        return json_encode($json);
    }

    public function revisoes()
    {
        return view('revisoes.revisoes');
    }

    public function editar_frm($id)
    {
        $data['revisao'] = Revisao::find($id);
        return $data['revisao'];
    }

    public function salvar(Request $request)
    {
        $mensagens = [
            'data.required' => 'O campo data é obrigatório.',
            'data.date' => 'O campo data deve ser uma data.',

            'km.required' => 'O campo km é obrigatório.',
            'km.numeric' => 'O campo km deve ser numércio.',

            'tipo_revisao.required' => 'O campo tipo revisão é obrigatório.',
            'tipo_revisao.min' => 'O campo tipo revisão deve ter pelo menos :min caracteres.',

            'custo.required' => 'O campo custo é obrigatório.',

            'veiculo.required' => 'O campo veiculo é obrigatório.',

            'custo.between' => 'O valor da revisão está fora do padrão.',
        ];


        $validate = $request->validate([
            'km' => 'required|numeric',
            'data' => 'required|date',
            'tipo_revisao' => 'required|min:5',
            'custo' => 'required|between:5,10',
            'veiculo' => 'required'
        ], $mensagens);

        $revisao = new Revisao();
        $revisao->km = $request->input('km');
        $revisao->data = $request->input('data');
        $revisao->tipo_revisao = $request->input('tipo_revisao');
        $revisao->custo = $request->input('custo');
        $revisao->id_veiculo = $request->input('veiculo');

        // tratar se teve éxito e enviar erros
        try {
            $revisao->save();
            return "Cadastrado";
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    public function editar(Request $request)
    {
        $mensagens = [
            'km.required' => 'O campo km é obrigatório.',
            'km.numeric' => 'O campo km deve ser numércio.',

            'tipo_revisao.required' => 'O campo tipo revisão é obrigatório.',
            'tipo_revisao.min' => 'O campo tipo revisão deve ter pelo menos :min caracteres.',

            'custo.required' => 'O campo custo é obrigatório.',

            'custo.between' => 'O valor da revisão está fora do padrão.',
        ];


        $validate = $request->validate([
            'km' => 'required|numeric',
            'tipo_revisao' => 'required|min:5',
            'custo' => 'required|between:6,10',
        ], $mensagens);

        $revisao = Revisao::find($request->input('id'));
        $revisao->km = $request->input('km');
        $revisao->data = $request->input('data');
        $revisao->tipo_revisao = $request->input('tipo_revisao');
        $revisao->custo = $request->input('custo');

        // tratar se teve éxito e enviar erros
        try {
            $revisao->save();
            return "Atualizado";
        } catch (\Throwable $th) {
            return $th->getMessage();
        }

    }

    public function deletar(Request $request)
    {
        $revisao = Revisao::find($request->id_rd);

        // tratar se teve éxito e enviar erros
        try {
            $revisao->delete();
            return "Deletado";
        } catch (\Throwable $th) {
            return $th->getMessage();
        }

    }

}
