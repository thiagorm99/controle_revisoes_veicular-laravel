@extends('master')
@section('conteudo')
    <div class="container-fluid">
        <h2>Gestão</h2>
        <hr>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal_cadastrar_proprietario">
            Cadastrar proprietário
        </button>
        <hr>

        <table class="display" id="tabela_proprietarios">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Endereço</th>
                    <th>Telefone</th>
                    <th>Sexo</th>
                    <th>Data de nascimento</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>


        <!-- Modal cadastrar proprietário -->
        <div class="modal" id="modal_cadastrar_proprietario">
            <div class="modal-dialog">
                <div class="modal-content">

                    <!-- Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Cadastro de proprietário</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <!-- Conteúdo modal -->
                    <div class="modal-body">
                        <form id="salvar_proprietario">
                            <div class="form-group">
                                <label for="nome">Nome:</label>
                                <input type="text" class="form-control" id="nome" name="nome" value=""
                                    required minlength="5" maxlength="50">
                            </div>
                            <div class="form-group">
                                <label for="endereco">Endereço:</label>
                                <input type="text" class="form-control" id="endereco" name="endereco" value=""
                                    required minlength="10" maxlength="50">
                            </div>
                            <div class="form-group">
                                <label for="telefone">Telefone:</label>
                                <input type="text" class="form-control telefone" id="telefone" name="telefone"
                                    value="" required maxlength="15">
                            </div>
                            <div class="form-group">
                                <label for="sexo">Sexo:</label>
                                <select class="form-control" name="sexo" required>
                                    <option></option>
                                    @foreach (config('constants.sexos') as $k => $sexo)
                                        <option @if ($k == old('sexo')) selected @endif
                                            value="{{ $k }}">
                                            {{ $sexo }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="data_nascimento">Data nascimento:</label>
                                <input type="text" class="form-control data_nascimento" id="data_nascimento"
                                    name="data_nascimento" value="" required>
                            </div>

                            <!-- Footer -->
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Salvar</button>
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>

        <!-- Modal editar proprietário -->
        <div class="modal" id="modal_editar_proprietario">
            <div class="modal-dialog">
                <div class="modal-content">

                    <!-- Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Editar de proprietário</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <!-- Conteúdo modal -->
                    <div class="modal-body">
                        <form id="editar_proprietario">
                            @csrf
                            <input type="hidden" id="id_p" name="id" value="">
                            <div class="form-group">
                                <label for="nome">Nome:</label>
                                <input type="text" class="form-control" id="nome_p" name="nome" value=""
                                    required minlength="5" maxlength="50">
                            </div>
                            <div class="form-group">
                                <label for="endereco">Endereço:</label>
                                <input type="text" class="form-control" id="endereco_p" name="endereco" value=""
                                    required minlength="10" maxlength="50">
                            </div>
                            <div class="form-group">
                                <label for="telefone">Telefone:</label>
                                <input type="text" class="form-control telefone" id="telefone_p" name="telefone"
                                    class="telefone" value="" required maxlength="15">
                            </div>
                            <div class="form-group">
                                <label for="sexo">Sexo:</label>
                                <select class="form-control" name="sexo" id="sexo_p" required>
                                    <option></option>
                                    @foreach (config('constants.sexos') as $k => $sexo)
                                        <option value="{{ $k }}">
                                            {{ $sexo }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="data_nascimento">Data nascimento:</label>
                                <input type="text" class="form-control data_nascimento" id="data_nascimento_p"
                                    name="data_nascimento" class="data_nascimento" value="" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Salvar</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                        </form>
                    </div>

                </div>
            </div>
        </div>

        <!-- Modal deletar proprietário -->
        <div class="modal" id="modal_deletar_proprietario">
            <div class="modal-dialog">
                <div class="modal-content">

                    <!-- Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Deletar de proprietário?</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <!-- Conteúdo modal -->
                    <div class="modal-body">
                        <form id="deletar_proprietario">
                            @csrf
                            <input type="hidden" id="id_pd" name="id_pd" value="">
                            <button type="submit" class="btn btn-primary">Deletar</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                        </form>
                    </div>

                </div>
            </div>
        </div>

        <!-- Modal veículos -->
        <div class="modal" id="modal_veiculos">
            <div class="container">
                <div class="modal-content">

                    <!-- Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Veículos</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <!-- Conteúdo modal -->
                    <div class="container-fluid">
                        <br>
                        <input type="hidden" name="id_proprietario_db" id="id_proprietario_db">
                        <button type="button" class="btn btn-primary" data-toggle="modal"
                            onclick="botao_cadastrar_veiculo()">
                            Cadastrar
                        </button>
                        <hr>
                        <table class="display" id="tabela_veiculos" style="margin: 0; width: 100%">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Marca</th>
                                    <th>Modelo</th>
                                    <th>Ano</th>
                                    <th>Placa</th>
                                    <th>Nome Proprietario</th>
                                    <th>Ultima revisao</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>

                        <!-- Modal cadastrar veículo -->
                        <div class="modal" id="modal_cadastrar_veiculo">
                            <div class="modal-dialog">
                                <div class="modal-content">

                                    <!-- Header -->
                                    <div class="modal-header">
                                        <h4 class="modal-title">Cadastro de veículo</h4>
                                        <button type="button" class="close"
                                            onclick="$('#modal_cadastrar_veiculo').hide()">&times;</button>
                                    </div>

                                    <!-- Conteúdo modal -->
                                    <div class="modal-body">
                                        <form id="salvar_veiculo">
                                            <div class="form-group">
                                                <label for="marca">Marca:</label>
                                                <select class="form-control" name="marca" required>
                                                    <option></option>
                                                    @foreach (config('constants.marcas') as $marca)
                                                        <option value="{{ $marca }}">
                                                            {{ $marca }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="modelo">Modelo:</label>
                                                <input type="text" class="form-control" id="modelo" name="modelo"
                                                    value="" required maxlength="30">
                                            </div>
                                            <div class="form-group">
                                                <label for="ano">Ano:</label>
                                                <input type="number" class="form-control ano" id="ano"
                                                    class="ano" name="ano">
                                            </div>
                                            <div class="form-group">
                                                <label for="placa">Placa:</label>
                                                <input type="text" class="form-control placa" id="placa"
                                                    class="placa" name="placa" value="" required
                                                    maxlength="10">
                                            </div>
                                            <div class="form-group">
                                                <input type="hidden" id="proprietario" name="proprietario"
                                                    value="" required>
                                            </div>

                                            <!-- Footer -->
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary">Salvar</button>
                                                <button type="button" class="btn btn-danger"
                                                    onclick="$('#modal_cadastrar_veiculo').hide()">Cancelar</button>
                                            </div>
                                        </form>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <!-- Modal editar veículo -->
                        <div class="modal" id="modal_editar_veiculo">
                            <div class="modal-dialog">
                                <div class="modal-content">

                                    <!-- Header -->
                                    <div class="modal-header">
                                        <h4 class="modal-title">Editar de veículo</h4>
                                        <button type="button" class="close"
                                            onclick="$('#modal_editar_veiculo').hide();">&times;</button>
                                    </div>

                                    <!-- Conteúdo modal -->
                                    <div class="modal-body">

                                        <form id="editar_veiculo">
                                            <input type="hidden" id="id_v" name="id" value="" required>
                                            <div class="form-group">
                                                <label for="marca">Marca:</label>
                                                <select class="form-control" name="marca" id="marca_v" required>
                                                    <option></option>
                                                    @foreach (config('constants.marcas') as $marca)
                                                        <option value="{{ $marca }}">
                                                            {{ $marca }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="modelo">Modelo:</label>
                                                <input type="text" class="form-control" id="modelo_v" name="modelo"
                                                    value="" required max="30">
                                            </div>
                                            <div class="form-group">
                                                <label for="ano">Ano:</label>
                                                <input type="number" class="form-control ano" id="ano_v"
                                                    name="ano" value="" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="placa">Placa:</label>
                                                <input type="text" class="form-control placa" id="placa_v"
                                                    name="placa" value="" required maxlength="10">
                                            </div>
                                            <div class="form-group">
                                                <input type="hidden" id="proprietario_v" name="proprietario"
                                                    value="" required>
                                            </div>


                                            <!-- Footer -->
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary">Salvar</button>
                                                <button type="button" class="btn btn-danger"
                                                    onclick="$('#modal_editar_veiculo').hide();">Cancelar</button>
                                            </div>
                                        </form>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <!-- Modal cadastrar revisão -->
                        <div class="modal" id="modal_cadastrar_revisao">
                            <div class="modal-dialog">
                                <div class="modal-content">

                                    <!-- Header -->
                                    <div class="modal-header">
                                        <h4 class="modal-title">Cadastrar uma revisão</h4>
                                        <button type="button" class="close"
                                            onclick="$('#modal_cadastrar_revisao').hide()">&times;</button>
                                    </div>

                                    <!-- Conteúdo modal -->
                                    <div class="modal-body">

                                        <form id="salvar_revisao">
                                            <div class="form-group">
                                                <label for="data">Data:</label>
                                                <input type="text" class="form-control data_nascimento" id="data"
                                                    name="data" value="" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="km">KM:</label>
                                                <input type="number" class="form-control km" id="km"
                                                    name="km" value="" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="tipo_revisao">Tipo Revisao:</label>
                                                <input type="text" class="form-control" id="tipo_revisao"
                                                    name="tipo_revisao" value="" required minlength="5"
                                                    maxlength="50">
                                            </div>
                                            <div class="form-group">
                                                <label for="custo">Custo:</label>
                                                <input type="text" class="form-control custo" id="custo"
                                                    name="custo" value="" required>
                                            </div>
                                            <div>
                                                <input type="hidden" name="veiculo" id="veiculo_r" required>
                                            </div>
                                            <!-- Footer -->
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary">Salvar</button>
                                                <button type="button" class="btn btn-danger"
                                                    onclick="$('#modal_cadastrar_revisao').hide()">Cancelar</button>
                                            </div>
                                        </form>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <!-- Modal deletar veículo -->
                        <div class="modal" id="modal_deletar_veiculo">
                            <div class="modal-dialog">
                                <div class="modal-content">

                                    <!-- Header -->
                                    <div class="modal-header">
                                        <h4 class="modal-title">Deletar de veículo?</h4>
                                        <button type="button" class="close"
                                            onclick="$('#modal_deletar_veiculo').hide()">&times;</button>
                                    </div>

                                    <!-- Conteúdo modal -->
                                    <div class="modal-body">
                                        <form id="deletar_veiculo">
                                            <input type="hidden" id="id_vd" name="id_vd" value="">
                                            <button type="submit" class="btn btn-primary">Deletar</button>
                                            <button type="button" class="btn btn-danger"
                                                onclick="$('#modal_deletar_veiculo').hide()">Cancelar</button>
                                        </form>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal revisoes -->
        <div class="modal" id="modal_revisoes">
            <div class="container">
                <div class="modal-content">

                    <!-- Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Revisoes</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <!-- Conteúdo modal -->
                    <div class="container-fluid">
                        <table class="display" id="tabela_revisoes">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Data</th>
                                    <th>km</th>
                                    <th>Tipo Revisão</th>
                                    <th>Custo</th>
                                    <th>Marca</th>
                                    <th>Modelo</th>
                                    <th>Ano</th>
                                    <th>Placa</th>
                                    <th>Nome Proprietario</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>

                        <!-- Modal editar revisão -->
                        <div class="modal" id="modal_editar_revisao">
                            <div class="modal-dialog">
                                <div class="modal-content">

                                    <!-- Header -->
                                    <div class="modal-header">
                                        <h4 class="modal-title">Editar uma revisão</h4>
                                        <button type="button" class="close" onclick="$('#modal_editar_revisao').hide();">&times;</button>
                                    </div>

                                    <!-- Conteúdo modal -->
                                    <div class="modal-body">

                                        <form id="editar_revisao">
                                            <input type="hidden" name="id" value="" id="id_r">
                                            <div class="form-group">
                                                <label for="data">Data:</label>
                                                <input type="text" class="form-control data_nascimento" id="data_rev"
                                                    name="data" value="" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="modelo">KM:</label>
                                                <input type="number" class="form-control km" id="km_r"
                                                    name="km" value="" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="ano">Tipo Revisao:</label>
                                                <input type="text" class="form-control" id="tipo_revisao_r"
                                                    name="tipo_revisao" value="" required minlength="5"
                                                    maxlength="50">
                                            </div>
                                            <div class="form-group">
                                                <label for="placa">Custo:</label>
                                                <input type="text" class="form-control custo" id="custo_r"
                                                    name="custo" value="" required>
                                            </div>
                                            <!-- Footer -->
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary">Salvar</button>
                                                <button type="button" class="btn btn-danger"
                                                    onclick="$('#modal_editar_revisao').hide();">Cancelar</button>
                                            </div>
                                        </form>
                                    </div>

                                </div>
                            </div>
                        </div>


                        <!-- Modal deletar revisao -->
                        <div class="modal" id="modal_deletar_revisao">
                            <div class="modal-dialog">
                                <div class="modal-content">

                                    <!-- Header -->
                                    <div class="modal-header">
                                        <h4 class="modal-title">Deletar de revisão?</h4>
                                        <button type="button" class="close" onclick="$('#modal_deletar_revisao').hide();">&times;</button>
                                    </div>

                                    <!-- Conteúdo modal -->
                                    <div class="modal-body">
                                        <form id="deletar_revisao">
                                            <input type="hidden" id="id_rd" name="id_rd" value="">
                                            <button type="submit" class="btn btn-primary">Deletar</button>
                                            <button type="button" class="btn btn-danger"
                                            onclick="$('#modal_deletar_revisao').hide();">Cancelar</button>
                                        </form>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
@stop
