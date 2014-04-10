<?php
//take email, username

//generate password

//md5 it

$password = md5('gf45_gdf#4hg');


$cost = 10;
$salt = strtr(base64_encode(mcrypt_create_iv(16, MCRYPT_DEV_URANDOM)), '+', '.');
$salt = sprintf("$2a$%02d$", $cost) . $salt;
$hash = crypt($password, $salt);


//send original passwd and username to email