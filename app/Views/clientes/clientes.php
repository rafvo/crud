<!-- arquivo padrão do layout -->
<?= $this->extend('layout/main') ?>

<!-- página de clientes -->
<?= $this->section('content') ?>
<section>
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h5 class="mb-0 text-gray-800"><i class="fas fa-users pr-2"></i>Clientes</h5>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-header">
                    <div class="row">
                        <div class="col-auto mr-auto">
                            <i class="fas fa-table mr-1"></i>
                            Lista de Clientes
                        </div>
                        <div class="col-auto">
                            <button type="button" class="btn btn-sm btn-success" onclick="MODAL.ModalClientes()">
                                <i class="fas fa-plus pr-2"></i>Novo Cliente
                            </button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div id="lista_clientes"></div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- modal -->
<div id="modal_confirmacao" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h6 class="modal-title text-white"><i class="fas fa-trash-alt pr-2"></i>Confirmar Remoção</h6>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Fechar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <span id="mensagem_confirmacao"></span>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
                    <i class="fas fa-times pr-2"></i>Não
                </button>
                <button type="button" class="btn btn-success" onclick="FORM.RemoverCliente()">
                    <i class="fas fa-check pr-2"></i>Sim
                </button>
            </div>
        </div>
    </div>
</div>

<!-- modal -->
<div id="modal_clientes" class="modal" tabindex="-1" role="dialog" data-bs-backdrop="static" data-bs-keyboard="false"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title"></h6>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Fechar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="form_clientes" method="POST">
                    <div class="form-row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="nome">Nome Completo<span class="ml-2 text-danger">*</span></label>
                                <input type="text" class="form-control" id="nome" name="nome"
                                    placeholder="Informe seu nome completo">
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="rg">RG<span class="ml-2 text-danger">*</span></label>
                                <input type="text" class="form-control rg" id="rg" name="rg" placeholder="00.000.000-0">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="cpf">CPF<span class="ml-2 text-danger">*</span></label>
                                <input type="text" class="form-control cpf" id="cpf" name="cpf"
                                    placeholder="000.000.000-00">
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-5">
                            <div class="form-group date">
                                <label for="rg">Data de Nascimento<span class="ml-2 text-danger">*</span></label>
                                <input type="text" class="form-control datepicker-v1 data" id="data_nasc" name="data_nasc"
                                    placeholder="dd/mm/aaaa">
                            </div>
                        </div>
                    </div>
                    <div class="load"></div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-danger" data-bs-dismiss="modal">
                    <i class="fas fa-times pr-2"></i>Cancelar
                </button>
                <button type="button" class="btn btn-sm btn-success" onclick="FORM.SalvarCliente()">
                    <i class="fas fa-save pr-2"></i>Salvar
                </button>
            </div>
        </div>
    </div>
</div>

<script src="assets/internal/js/masks.js"></script>
<script src="assets/internal/js/datepicker.js"></script>
<script src="assets/internal/js/datatables.js"></script>

<script>

$(document).ready(function() {
    LOAD.Clientes();
    MODAL.Modal();
    FORM.Validacao();
    MASK.Masks();
    DATEPICKER.DatepickerV1();
});

var VAR = {
    COD_PESSOA: null,
    URL: null,
}

var LOAD = {
    Clientes: function(){
        $.ajax({
            method: "GET",
            url: "clientes/listaClientesJSON",
            dataType: 'json',
            success: function(result) {
                TABLE.TabelaClientes(result);
            },
            error: function() {
                $.notify(
                    'Erro ao carregar',
                    'error'
                );
            }
        });
    }
}

var TABLE = {
    TabelaClientes: function(clientes){
        $("#lista_clientes").html(
            '<table class="table datatable" id="tabela_clientes">'+
                '<thead>'+
                    '<tr class="text-center">'+
                        '<th>Código</th>'+
                        '<th>Nome</th>'+
                        '<th>RG</th>'+
                        '<th>CPF</th>'+
                        '<th>Data de Nascimento</th>'+
                        '<th>Data de Registro</th>'+
                        '<th nowrap>Data de Atualização</th>'+
                        '<th>Status</th>'+
                        '<th>Ações</th>'+
                    '</tr>'+
                '</thead>'+
                '<tbody>');

        $.each(clientes, function (key, item) {
            TABLE.AdicionarCliente(item);
        });
        $("tabela_clientes").append('</tbody></table>');
        DATATABLES.DataTableClass();
    },
    RemoverCliente: function(codigo){
        $('#cliente-'+codigo).remove();
    },
    AdicionarCliente: function(cliente){
        $('#tabela_clientes tbody').prepend(
            '<tr class="text-center" id="cliente-'+cliente.id_pessoa+'">'+
                '<td>'+cliente.id_pessoa+'</td>'+
                '<td>'+cliente.nome_completo+'</td>'+
                '<td nowrap>'+cliente.rg+'</td>'+
                '<td nowrap>'+cliente.cpf+'</td>'+
                '<td>'+cliente.data_nasc+'</td>');

            $('#cliente-'+cliente.id_pessoa).append(  
                '<td>'+cliente.data_registro+'</td>');

            if(!empty(cliente.data_atualizacao)){
                $('#cliente-'+cliente.id_pessoa).append(
                    '<td>'+cliente.data_atualizacao+'</td>'
                );
            } else {
                $('#cliente-'+cliente.id_pessoa).append(
                    '<td>-</td>'
                );
            }

            if(cliente.status == 'A'){
                $('#cliente-'+cliente.id_pessoa).append(
                    '<td><span class="badge badge-pill badge-success">Ativo</span></td>'
                );
            } else if(cliente.status == 'I'){
                $('#cliente-'+cliente.id_pessoa).append(
                    '<td><span class="badge badge-pill badge-danger">Inativo</span></td>'
                );
            } else {
                $('#cliente-'+cliente.id_pessoa).append(
                    '<td><span class="badge badge-pill badge-light text-dark">Indefinido</span></td>'
                );
            }

            $('#cliente-'+cliente.id_pessoa).append(  
                '<td><a class="text-decoration-none" href="javascript:void(0);" onclick="MODAL.ModalClientes('+cliente.id_pessoa+')">'+
                   '<i class="fas fa-pen text-warning"></i>'+
                '</a>'+
                '<a class="text-decoration-none ml-2" href="javascript:void(0);" onclick="MODAL.ConfirmarRemocao('+cliente.id_pessoa+')">'+
                    '<i class="fas fa-trash-alt text-danger"></i>'+
                '</a>'+
            '</tr>');
    },
}

var MODAL = {
    Modal: function() {
        $('#modal_clientes').on('hidden.bs.modal', function(e) {
            if (VAR.COD_PESSOA != null) {
                $("#form_clientes").trigger('reset');
            }
        });
    },
    ModalClientes: function(id=null) {
        VAR.COD_PESSOA = id;
        if (VAR.COD_PESSOA == null) {
            $('#modal_clientes .modal-title').html(
                '<i class="fas fa-plus pr-2"></i>Adicionar Cliente');
            VAR.URL = 'inserir';
        } else {
            FORM.ClienteID();
            $('#modal_clientes .modal-title').html('<i class="fas fa-pen pr-2"></i>Editar Cliente');
            VAR.URL = 'atualizar';
        }
        $("#modal_clientes").modal('show');
    },
    ConfirmarRemocao: function(id){
        VAR.COD_PESSOA = id;
        $('#mensagem_confirmacao').html('Tem certeza que deseja remover o cliente de código: <strong>'+VAR.COD_PESSOA+'</strong>?');
        $('#modal_confirmacao').modal('show');
    },
}

var FORM = {
    SalvarCliente: function() {
        var form   = $('#form_clientes');
        var tabela = $("#tabela_clientes");
        var modal  = $('#modal_clientes');
        /*array de dados do formulário*/
        var dados  = form.serializeArray();

        /*adicionando o valor da variável global no array*/
        dados.push({
            name: 'cod_pessoa',
            value: VAR.COD_PESSOA
        });

        if(form.valid()) {
            $.ajax({
                method: 'POST',
                url: 'clientes/'+VAR.URL,
                data: dados,
                dataType: 'json',
                success: function(result) {

                    /*registro inserido*/
                    if (result.status == 1) {
                        $('#nenhum-registro').remove();
                        form.trigger('reset');
                        tabela.DataTable().destroy();
                        TABLE.RemoverCliente(result.dados.id_pessoa);
                        TABLE.AdicionarCliente(result.dados);
                        DATATABLES.DataTableClass();

                        modal.modal('hide');

                        $.notify(
                            result.mensagem,
                            'success' 
                        );
                    }
                    /*registro não inserido*/
                    else if (result.status == 2) {
                        $.notify(
                            result.mensagem,
                            'info'
                        );
                    }
                    /*erro ao inserir*/
                    else if (result.status == 3) {
                        $.notify(
                            result.mensagem,
                            'error'
                        );
                    }
                },
                error: function() {
                    $.notify(
                        'Erro ao salvar',
                        'error'
                    );
                }
            });
        } else {
            return false;
        }
    },
    RemoverCliente: function(){
        var tabela = $("#tabela_clientes");
        var modal  = $('#modal_confirmacao');
        $.ajax({
            method: 'POST',
            url: 'clientes/deletar',
            data: {cod_pessoa: VAR.COD_PESSOA},
            dataType: 'json',
            success: function(result) {

                /*registro removido*/
                if (result.status == 1) {
                    tabela.DataTable().destroy();
                    TABLE.RemoverCliente(VAR.COD_PESSOA);
                    DATATABLES.DataTableClass();

                    modal.modal('hide');

                    $.notify(
                        result.mensagem,
                        'success' 
                    );
                }
                /*registro não removido*/
                else if (result.status == 2) {
                    $.notify(
                        result.mensagem,
                        'info'
                    );
                }
                /*erro ao remover*/
                else if (result.status == 3) {
                    $.notify(
                        result.mensagem,
                        'error'
                    );
                }
            },
            error: function() {
                $.notify(
                    'Erro ao remover',
                    'error'
                );
            }
        });
    },
    ClienteID: function() {
        $.ajax({
            method: "POST",
            url: "clientes/listaUniJSON",
            data: {
                cod_pessoa: VAR.COD_PESSOA
            },
            dataType: 'json',
            success: function(result) {
                $("#nome").val(result.nome_completo);
                $("#rg").val(result.rg);
                $("#cpf").val(result.cpf);
                $("#data_nasc").datepicker("setDate", new Date(result.data_nasc_field));
            },
            error: function() {
                $.notify(
                    'Erro ao carregar',
                    'error'
                );
            }
        });
    },
    Validacao: function() {
        /*validações*/
        $('#form_clientes').validate({
            rules: {
                'nome': {
                    required: true,
                    maxlength: 150
                },
                'rg': {
                    required: true,
                    minlength: 12
                },
                'cpf': {
                    required: true,
                    minlength: 14
                },
                'data_nasc': {
                    required: true,
                    minlength: 10
                }
            },
            messages: {
                'nome': {
                    required: 'Nome Completo é obrigatório',
                    maxlength: 'Limite: 150 caracteres'
                },
                'rg': {
                    required: 'RG é obrigatório',
                    minlength: 'Informe o RG completo'
                },
                'cpf': {
                    required: 'CPF é obrigatório',
                    minlength: 'Informe o CPF completo'
                },
                'data_nasc': {
                    required: 'Data de Nascimento é obrigatório',
                    minlength: 'Informe a Data de Nascimento completa'
                }
            },
            errorPlacement: function(error, element) {
                error.insertAfter(element);
            }
        });
    }
}

</script>

<?= $this->endSection() ?>