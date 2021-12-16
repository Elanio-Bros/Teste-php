{% extends 'template.twig.php' %}
{% block title %}Login{% endblock %}
{% block style %}
<style>
    .login-form {
        width: 40%;
        font-size: 15px;
    }

    .h-100 {
        height: 100vh !important;
    }

    form {
        margin-bottom: 15px;
        background: #f7f7f7;
        box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
    }

    /* 
    .login-form h2 {
        margin: 0 0 15px;
    } 
    */

    .form-control,
    .btn {
        width: 100%;
        border-radius: 2px;
    }
</style>
{% endblock %}
{% block content %}
<div class="h-100 center d-flex flex-column justify-content-center align-items-center align-self-center">
    <div class="login-form">
        {% if error != null %}
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{error}}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        {% endif %}
        <form action="" method="post" class="p-4">
            <h2 class="text-center m-3">Login</h2>
            <div class="form-group my-2">
                <input type="text" class="form-control" placeholder="Usuário/Email" name="usuario" value="{{usuario}}" required="required">
            </div>
            <div class="input-group mb-3">
                <input type="password" name="senha" class="form-control" id="pass" placeholder="Senha" required>
                <div class="input-group-append">
                    <span class="input-group-text" id="basic-addon2"><a class="ocultaPass">
                            <i class="fas fa-eye" style="display: none"></i>
                            <i class="fas fa-eye-slash"></i></a></span>
                </div>
            </div>
            <div class="form-group my-2">
                <button type="submit" class="btn btn-primary btn-block">Login</button>
            </div>
            <div class="my-2">
                <label class="float-left form-check-label">
                    <input type="checkbox" name="remeber" class="mx-1">Remember me
                </label>
            </div>
            <!-- <p class="text-center"><a href="{{route('conta')}}">Criar Conta</a></p> -->
        </form>

    </div>
</div>
{% endblock %}
{% block script %}
<script>
    $(".ocultaPass").click(function() {
        $(this).children("i").toggle();
        let inputSenha = $(this).closest('.input-group').find('input');
        inputSenha.prop("type", inputSenha.prop("type") == "password" ? "text" : "password");
    });
</script>
{% endblock %}