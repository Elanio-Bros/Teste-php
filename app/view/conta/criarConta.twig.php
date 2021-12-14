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
        <form action="" method="post" class="p-4">
            <h2 class="text-center m-3">Criar Conta</h2>
            <div class="form-group my-2">
                <input type="text" class="form-control" placeholder="Nome" required="required">
            </div>
            <div class="form-group my-2">
                <input type="text" class="form-control" placeholder="Usuário" required="required">
            </div>
            <div class="form-group my-2">
                <input type="password" class="form-control" placeholder="Senha" required="required">
            </div>
            <div class="form-group my-2">
                <input type="password" class="form-control" placeholder="Confirmação de Senha" required="required">
            </div>
            <div class="form-group my-2">
                <button type="submit" class="btn btn-primary btn-block">Criar Conta</button>
            </div>
            <p class="text-center"><a href="{{route('home')}}">Já Tenho Conta</a></p>
        </form>
    </div>
</div>
{% endblock %}