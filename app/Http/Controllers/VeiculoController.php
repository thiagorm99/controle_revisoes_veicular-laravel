<?php

namespace App\Http\Controllers;

use App\Models\Proprietario;
use App\Models\Veiculo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VeiculoController extends Controller
{
    public function veiculos_api($id_proprietario)
    {
        $data['veiculos'] = DB::select("
        SELECT
        v.id AS id,
        v.marca AS marca,
        v.modelo AS modelo,
        v.ano AS ano,
        v.placa AS placa,
        p.nome AS nome,
        MAX(r.data) AS data_ultima_revisao
    FROM
        veiculos AS v
        INNER JOIN proprietarios AS p ON v.id_proprietario = p.id
        LEFT JOIN revisoes AS r ON r.id_veiculo = v.id
    WHERE v.id_proprietario = $id_proprietario
    GROUP BY
        v.id,
        v.marca,
        v.modelo,
        v.ano,
        v.placa,
        p.nome
    ORDER BY
        v.id
        ");


        $json = [];

        foreach ($data['veiculos'] as $key => $value) {
            $json["data"][] = [
                "id" => $value->id,
                "marca" => $value->marca,
                "modelo" => $value->modelo,
                "ano" => $value->ano,
                "placa" => $value->placa,
                "nome" => $value->nome,
                "data_ultima_revisao" => ($value->data_ultima_revisao != null) ? date('d-m-Y', strtotime($value->data_ultima_revisao)) : '',
                "acoes" => $value->id,
            ];
        }

        if (!count($data['veiculos']) >= 1) {
            return json_encode(null);
        }

        return json_encode($json);
    }

    public function veiculos()
    {

        $data['proprietarios'] = Proprietario::all();
        return view('veiculos.veiculos', $data);
    }

    public function editar_frm($id)
    {
        $data['veiculo'] = Veiculo::find($id);
        return $data['veiculo'];
    }

    public function salvar(Request $request)
    {

        $mensagens = [
            'marca.required' => 'O campo marca é obrigatório.',
            'marca.max' => 'O campo marca não deve ter mais de :max caracteres.',

            'modelo.required' => 'O campo modelo é obrigatório.',
            'modelo.max' => 'O campo modelo não deve ter mais de :max caracteres.',

            'ano.required' => 'O campo ano é obrigatório.',
            'ano.numeric' => 'O campo ano deve ser numérico.',

            'placa.required' => 'O campo placa é obrigatório.',
            'placa.max' => 'O campo placa deve ter :max caracteres.',

            'proprietario.required' => 'O campo proprietario é obrigatório.',

            'ano.between' => 'O ano de veículo está fora do padrão.',
        ];


        $validate = $request->validate([
            'marca' => 'required|max:30',
            'modelo' => 'required|max:30',
            'ano' => 'required|numeric|between:1950,2024',
            'placa' => 'required|max:15',
            'proprietario' => 'required'
        ], $mensagens);

        $veiculo = new Veiculo();
        $veiculo->marca = $request->input('marca');
        $veiculo->modelo = $request->input('modelo');
        $veiculo->ano = $request->input('ano');
        $veiculo->placa = $request->input('placa');
        $veiculo->id_proprietario = $request->input('proprietario');

        // tratar se teve éxito e enviar erros
        try {
            $veiculo->save();
            return "Cadastrado";
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    public function editar(Request $request)
    {

        $mensagens = [
            'marca.required' => 'O campo marca é obrigatório.',
            'marca.max' => 'O campo marca não deve ter mais de :max caracteres.',

            'modelo.required' => 'O campo modelo é obrigatório.',
            'modelo.max' => 'O campo modelo não deve ter mais de :max caracteres.',

            'ano.required' => 'O campo ano é obrigatório.',
            'ano.digits' => 'O campo ano deve ter :digits caracteres.',
            'ano.numeric' => 'O campo ano deve ser numérico.',

            'placa.required' => 'O campo placa é obrigatório.',
            'placa.max' => 'O campo placa deve ter :max caracteres.',

            'proprietario.required' => 'O campo proprietario é obrigatório.',

            'ano.between' => 'O ano de veículo está fora do padrão.',
        ];


        $validate = $request->validate([
            'marca' => 'required|max:15',
            'modelo' => 'required|max:30',
            'ano' => 'required|numeric|between:1950,2024',
            'placa' => 'required|max:10',
            'proprietario' => 'required'
        ], $mensagens);
        $veiculo = Veiculo::find($request->input('id'));
        $veiculo->marca = $request->input('marca');
        $veiculo->modelo = $request->input('modelo');
        $veiculo->ano = $request->input('ano');
        $veiculo->placa = $request->input('placa');
        $veiculo->id_proprietario = $request->input('proprietario');

        // tratar se teve éxito e enviar erros
        try {
            $veiculo->save();
            return "Atualizado";
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    public function deletar(Request $request)
    {
        $veiculo = Veiculo::find($request->id_vd);

        // tratar se teve éxito e enviar erros
        try {
            $veiculo->delete();
            return "Deletado";
        } catch (\Throwable $th) {
            return "Não foi possível deletar - esse registro tem restrições";
        }
    }
}
