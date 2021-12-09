<?php


// $this->get('/home', function () {
//     echo 'estou na home';
// });
$this->get('/', function () {
    echo 'home';
});
$this->get('/home', function () {
    echo 'entrada';
});
$this->get('/teste', function () {
    echo 'test';
});
