<?php
require_once 'core/init.php';

$user = DB::getInstance()->update('users', 2, array(
    'haslo'=>'password',
    'nazwisko'=>'Winicjusz',
    'email'=>'wpt@wp.pl',
    'salt'=>'salt'
));


?>

