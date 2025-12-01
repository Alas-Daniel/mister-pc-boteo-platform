<?php
$password = 'alas2020';
$hash = password_hash($password, PASSWORD_DEFAULT); // usa bcrypt o argon2 según tu PHP
echo $hash; // copia esto y guárdalo en la BD
