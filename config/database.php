<?php

$host = 'localhost';
$banco = 'atendelab';
$usuario = 'root';
$porta = '3307';
$senha = '';

try {
   $pdo = new PDO(
      "mysql:host=$host;port=$porta;dbname=$banco;charset=utf8",
      $usuario,
      $senha
   );

   $pdo->setAttribute(
      PDO::ATTR_ERRMODE,
      PDO::ERRMODE_EXCEPTION
   );
} catch (PDOException $e) {
 exit('Erro ao conectar com o banco de dados:');
}
