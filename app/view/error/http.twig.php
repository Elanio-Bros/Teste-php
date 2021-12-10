{% extends 'template.twig.php' %}
{% block title %}{{code}}{% endblock %}
{% block style %}
<style>
    body{
        background-color: #FA524B;
        color:white;
    }
    .mx-auto{
        height: 100vh;
    }
    h1{
        font-size:12vh;
    }
    h2{
        font-size:4vh;
    }
</style>
{% endblock %}
{% block content %}
<div class="mx-auto d-flex flex-column justify-content-center align-items-center">
    <h1>{{code}}</h1>
    <h2>{{messagem}}</h2>
</div>
{% endblock %}