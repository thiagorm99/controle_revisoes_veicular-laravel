<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProprietarioController;
use App\Http\Controllers\RelatoriosController;
use App\Http\Controllers\RevisoesController;
use App\Http\Controllers\VeiculoController;
use Illuminate\Support\Facades\Route;


Route::get('/proprietarios_api', [ProprietarioController::class, 'proprietarios_api'])
->name('proprietarios_api')->middleware('auth');

Route::get('/', [ProprietarioController::class, 'proprietarios'])
->name('proprietarios')->middleware('auth');

Route::get('/proprietarios/editar_frm/{id}', [ProprietarioController::class, 'editar_frm'])
->name('proprietarios_editar_frm')->middleware('auth');

Route::post('/proprietarios/salvar', [ProprietarioController::class, 'salvar'])
->name('proprietarios_salvar')->middleware('auth');

Route::post('/proprietarios/editar', [ProprietarioController::class, 'editar'])
->name('proprietarios_editar')->middleware('auth');

Route::post('/proprietarios/deletar', [ProprietarioController::class, 'deletar'])
->name('proprietarios_deletar')->middleware('auth');

//////////////////////////////////////

Route::get('/veiculos_api/{id}', [VeiculoController::class, 'veiculos_api'])
->name('veiculos_api')->middleware('auth');

Route::get('/veiculos/editar_frm/{id}', [VeiculoController::class, 'editar_frm'])
->name('veiculos_editar_frm')->middleware('auth');

Route::post('/veiculos/salvar', [VeiculoController::class, 'salvar'])
->name('veiculos_salvar')->middleware('auth');

Route::post('/veiculos/editar', [VeiculoController::class, 'editar'])
->name('veiculos_editar')->middleware('auth');

Route::post('/veiculos/deletar', [VeiculoController::class, 'deletar'])
->name('veiculos_deletar')->middleware('auth');

//////////////////////////////////////

Route::get('/revisoes_api/{id}', [RevisoesController::class, 'revisoes_api'])
->name('revisoes_api')->middleware('auth');

Route::get('/revisoes', [RevisoesController::class, 'revisoes'])
->name('revisoes')->middleware('auth');

Route::get('/revisoes/editar_frm/{id}', [RevisoesController::class, 'editar_frm'])
->name('revisoes_editar_frm')->middleware('auth');

Route::post('/revisoes/salvar', [RevisoesController::class, 'salvar'])
->name('revisoes_salvar')->middleware('auth');

Route::post('/revisoes/editar', [RevisoesController::class, 'editar'])
->name('revisoes_editar')->middleware('auth');

Route::post('/revisoes/deletar', [RevisoesController::class, 'deletar'])
->name('revisoes_deletar')->middleware('auth');

//////////////////////////////////////

Route::get('relatorios/veiculos/total_veiculos_proprietarios', [RelatoriosController::class, 'total_veiculos_proprietarios'])
->name('total_veiculos_proprietarios')->middleware('auth');

Route::get('relatorios/veiculos/total_veiculos_marca', [RelatoriosController::class, 'total_veiculos_marca'])
->name('total_veiculos_marca')->middleware('auth');

Route::get('relatorios/veiculos/total_veiculos_sexo', [RelatoriosController::class, 'total_veiculos_sexo'])
->name('total_veiculos_sexo')->middleware('auth');

Route::get('relatorios/veiculos/total_marcas_sexo', [RelatoriosController::class, 'total_marcas_sexo'])
->name('total_marcas_sexo')->middleware('auth');

Route::get('relatorios/proprietarios/media_idades', [RelatoriosController::class, 'media_idades'])
->name('media_idades')->middleware('auth');

Route::get('relatorios/revicoes/qtd_revisao_marca', [RelatoriosController::class, 'qtd_revisao_marca'])
->name('qtd_revisao_marca')->middleware('auth');

Route::get('relatorios/revicoes/qtd_revisao_pessoa', [RelatoriosController::class, 'qtd_revisao_pessoa'])
->name('qtd_revisao_pessoa')->middleware('auth');

Route::get("/dash", function(){
    return view("relatorios.vue");
})->name('dash')->middleware('auth');

//////////////////////////////////////

Route::get('/login', [LoginController::class, 'form'])
->name('login');

Route::post('/makelogin', [LoginController::class, 'logar'])
->name('logar');

Route::get('/sair', [LoginController::class, 'sair'])
->name('sair');

Route::get('/login/criar', [LoginController::class, 'criar'])
->name('criar_user');