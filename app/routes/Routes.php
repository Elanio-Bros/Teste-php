<?php

use App\Core\RouteCore;

Routecore::get('/', 'UsuarioController@login', 'home');
Routecore::get('/conta', 'UsuarioController@criarConta', 'conta');
Routecore::get('/conta/usuario', 'UsuarioController@criarConta', 'usuario');
Routecore::post('/conta', 'UsuarioController@criarConta');
