<?php
session_start();

$GLOBALS['config'] = array(
    'mysql' => array(
        'host'=>'127.0.0.1',
        'username'=>'robotechnic',
        'password'=>'Test1234',
        'db'=>'cb3'
    ),
    'remember'=>array(
        'cookie_name'=>'hash',
        'cookie_expiry'=>604800
    ),
    'session'=>array(
        'session_name'=>'user',
        'token_name'=> 'token'
    )
);

//zamiast wczytywania każdej klasy osobno:
spl_autoload_register(function($class){
    require_once 'classes/'.$class.'.php';
});

require_once 'functions/sanitize.php';

