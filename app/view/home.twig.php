{% extends 'template.twig.php' %}
{% block title %}Home{% endblock %}
{% block style %}
<style>
    table {
        border-collapse: collapse;
        table-layout: fixed;
        width: 100%;
    }

    table td {
        word-wrap: break-word;
    }
</style>
{% endblock %}
{% block content %}
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0"></ul>
            <a class="btn btn-outline-danger" href="{{route('logout')}}">
                Sair
            </a>
        </div>
    </div>
</nav>
<ul class="nav nav-tabs" id="myTab" role="tablist">
    <li class="nav-item" role="presentation">
        <button class="nav-link active" id="atividades-tab" data-bs-toggle="tab" data-bs-target="#atividades" type="button" role="tab" aria-controls="home" aria-selected="true">Tarefas</button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link" id="finalizadas-tab" data-bs-toggle="tab" data-bs-target="#finalizadas" type="button" role="tab" aria-controls="profile" aria-selected="false">Tarefas Finalizadas</button>
    </li>
</ul>
<div class="tab-content" id="myTabContent">
    <div class="tab-pane fade show active" id="atividades">
        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">
            <i class="fas fa-plus"></i>
        </button>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Finalizada</th>
                    <th scope="col">Título</th>
                    <th scope="col">Descrição</th>
                    <th scope="col">Tipo</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                {% for atividade in atividades %}
                <tr id="{{atividade.id}}">
                    <td><input type="checkbox" name="finalizado"></td>
                    <th scope="row">{{atividade.titulo}}</th>
                    <td>{{atividade.descrição}}</td>
                    <td>{{atividade.tipo_atividade}}</td>
                    <td class="d-flex flex-row">
                        <button type="button" class="btn btn-warning">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button type="button" class="btn  btn-danger">
                            <i class="fas fa-trash"></i>
                        </button>
                    </td>
                </tr>
                {% endfor %}
            </tbody>
        </table>
    </div>
    <div class="tab-pane fade" id="finalizadas">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Finalizada</th>
                    <th scope="col">Título</th>
                    <th scope="col">Descrição</th>
                    <th scope="col">Tipo</th>
                </tr>
            </thead>
            <tbody>
                {% for atividade in finalizadas %}
                <tr id="{{atividade.id}}">
                    <td><input type="checkbox" name="finalizado" checked></td>
                    <th scope="row">{{atividade.titulo}}</th>
                    <td>{{atividade.descrição}}</td>
                    <td>{{atividade.tipo_atividade}}</td>
                </tr>
                {% endfor %}
            </tbody>
        </table>
    </div>
</div>
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form class="modal-content" method="POST" action="{{route('registrar.atividade')}}">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Adicionar Tarefa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label">Título</label>
                    <input type="text" name="titulo" class="form-control">
                </div>
                <div class="mb-3">
                    <label class="form-label">Tipo</label>
                    <select class="form-select" name="tipo" aria-label="Default select example">
                        <option selected disabled>Selecione o Tipo de Atividade</option>
                        <option value="desenvolvimento">Desenvolvimento</option>
                        <option value="atendimento">Atendimento</option>
                        <option value="manutenção">Manutenção</option>
                        <option value="manutenção urgente">Manutenção Urgente</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Descrição</label>
                    <textarea class="form-control" name="descricao" id="exampleFormControlTextarea1" rows="3"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Salvar</button>
            </div>
        </form>
    </div>
</div>
{% endblock %}
{% block script %}
<script>
    $('input[name="finalizado"]').change(function() {
        if ($(this).prop("checked")) {
            $.ajax({
                url: "{{ route('atividade.finalizada') }}",
                type: "post",
                data: {
                    'id': $(this).closest('tr').prop("id"),
                    'finalizado': true,
                },
            }).done(function(response) {
                document.location.reload();
            })
        } else {
            $.ajax({
                url: "{{ route('atividade.finalizada') }}",
                type: "post",
                data: {
                    'id': $(this).closest('tr').prop("id"),
                    'finalizado': false,
                },
            }).done(function(response) {
                console.log(response);
                document.location.reload();
            });
        }
    })
</script>
{% endblock %}