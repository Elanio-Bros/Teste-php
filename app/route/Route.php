<?php

use App\Controller\TesteController;
// $this->get('/home', function () {
//     echo 'estou na home';
// });
$this->get('/', 'AtivadesController@entrada');
$this->post('/ola', 'AtivadesController@entrada');
// $this->get('/home', function () {
//     echo 'entrada';
// });
// $this->get('/teste', function () {
//     echo 'test';
// });
