<?php

$characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
$pwd = array();
$char_length = strlen($characters) - 1;
for ($i = 0; $i < rand(8, 20); $i++) {
    $n = rand(0, $char_length);
    $pwd[] = $characters[$n];
}

header('Content-type: application/json');

// encode en json l'array sous forme de string 
exit(json_encode(implode($pwd)));