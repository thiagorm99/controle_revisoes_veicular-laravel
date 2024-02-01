<?php

namespace App\Http\Controllers;

use App\Models\Proprietario;
use App\Models\Revisao;
use App\Models\Veiculo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

// Abaixo temos métodos geram os relátios e gráficos
// grande maiorio dos casos temos o exempo em
// sql puro e Eloquent ORM

class RelatoriosController extends Controller
{

    public function total_veiculos_marca()
    {
        // $dados = DB::select("
        // select v.marca as marca, count(v.id) as total_veiculo from veiculos as v
        // group by v.marca;
        // ");

        $dados = Veiculo::select('marca as marca', DB::raw('count(id) as total_veiculo'))
            ->groupBy('marca')
            ->get();

        verificar_registro($dados);

        foreach ($dados as $dado) {
            $x[] = $dado->marca;
            $y[] = $dado->total_veiculo;
        }
        $data = ['x' => json_encode($x), 'y' => json_encode($y)];
        return $data;
    }

    public function total_veiculos_sexo()
    {
        // $dados = DB::select("
        // select p.sexo as sexo, count(v.id) as total_veiculo from veiculos as v
        // inner join proprietarios as p on v.id_proprietario = p.id
        // group by sexo;
        // ");

        $dados = Veiculo::join('proprietarios as p', 'veiculos.id_proprietario', '=', 'p.id')
            ->select('p.sexo as sexo', DB::raw('count(veiculos.id) as total_veiculo'))
            ->groupBy('sexo')
            ->get();

        verificar_registro($dados);

        foreach ($dados as $dado) {
            $x[] = config('constants.sexos')[$dado->sexo];
            $y[] = $dado->total_veiculo;
        }
        $data = ['x' => json_encode($x), 'y' => json_encode($y)];

        return $data;
    }

    public function qtd_revisao_marca()
    {
        // $dados = DB::select("
        // select v.marca as marca, count(v.id) as total_veiculo
        // from veiculos as v
        // inner join revisoes as r on r.id_veiculo = v.id
        // group by v.marca;
        // ");

        $dados = Veiculo::join('revisoes as r', 'veiculos.id', '=', 'r.id_veiculo')
            ->select('veiculos.marca as marca', DB::raw('count(veiculos.id) as total_veiculo'))
            ->groupBy('marca')
            ->get();

        verificar_registro($dados);

        foreach ($dados as $dado) {
            $x[] = $dado->marca;
            $y[] = $dado->total_veiculo;
        }
        $data = ['x' => json_encode($x), 'y' => json_encode($y)];

        return $data;
    }


    public function qtd_revisao_pessoa()
    {
        // $dados = DB::select("
        // select p.nome as nome, count(r.id) as quantidade from revisoes as r
        // inner join veiculos as v on v.id = r.id_veiculo
        // inner join proprietarios as p on p.id = v.id_proprietario
        // group by nome;
        // ");

        $dados = Revisao::join('veiculos as v', 'revisoes.id_veiculo', '=', 'v.id')
            ->join('proprietarios as p', 'v.id_proprietario', '=', 'p.id')
            ->select('p.nome as nome', DB::raw('count(revisoes.id) as quantidade'))
            ->groupBy('nome')
            ->get();

        verificar_registro($dados);

        foreach ($dados as $dado) {
            $x[] = $dado->nome;
            $y[] = $dado->quantidade;
        }
        $data = ['x' => json_encode($x), 'y' => json_encode($y)];

        return $data;
    }
}
