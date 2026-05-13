<?php

function connectDatabase(): PDO {
   $dsn = 'mysql:host=127.0.0.1;dbname=blog;';
   $user = 'root';
   $password = '';
   return new PDO($dsn, $user, $password);
}

?>