<?php

use App\Core\RouteCore;

Routecore::get('/', 'UsuarioController@home', 'home');
Routecore::post('/', 'UsuarioController@login');
Routecore::get('/conta', 'UsuarioController@conta', 'conta');
Routecore::post('/conta', 'UsuarioController@criarConta');
Routecore::get('/logout', 'UsuarioController@logout', 'logout');
RouteCore::get('/home', 'AtivadesController@entrada', 'entrada');
RouteCore::post('/atividade', 'AtivadesController@registrarAtividade', 'registrar.atividade');
RouteCore::post('/finalizado', 'AtivadesController@atividadeFinalizada', 'atividade.finalizada');
