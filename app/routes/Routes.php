<?php

use App\Core\RouteCore;

Routecore::get('/', 'UsuarioController@home', 'home');
Routecore::post('/', 'UsuarioController@login');
// Routecore::get('/conta', 'UsuarioController@conta', 'conta');
// Routecore::post('/conta', 'UsuarioController@criarConta');
Routecore::get('/logout', 'UsuarioController@logout', 'logout');
RouteCore::get('/home', 'AtivadesController@entrada', 'entrada');
// Routes Atividades
RouteCore::post('/atividade', 'AtivadesController@registrarAtividade', 'registrar.atividade');
RouteCore::post('/atividade/finalizado', 'AtivadesController@atividadeFinalizada', 'atividade.finalizada');
RouteCore::post('/atividade/edit', 'AtivadesController@editarAtividade', 'editar.atividade');
RouteCore::post('/atividade/apagar', 'AtivadesController@apagarAtividade', 'apagar.atividade');
RouteCore::get('/atividade/json', 'AtivadesController@infoAtividade', 'atividade.json');
