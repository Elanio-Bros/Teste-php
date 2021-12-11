<?php

use App\Controller\TesteController;
// $this->get('/home', function () {
//     echo 'estou na home';
// });
$this->get('/', 'TesteController@entrada');
$this->post('/ola', 'TesteController@entrada');
// $this->get('/home', function () {
//     echo 'entrada';
// });
// $this->get('/teste', function () {
//     echo 'test';
// });
