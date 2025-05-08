<?php
// Este script é um exemplo de login simples, mas contém uma vulnerabilidade grave de segurança (SQL Injection)

// Cria uma conexão com o banco de dados MySQL usando o usuário 'root' e sem senha
$conn = new mysqli("localhost", "root", "", "usuarios");

// Verifica se houve erro ao tentar se conectar ao banco de dados
if ($conn->connect_error) {
    // Caso haja erro, a execução é encerrada e a mensagem de erro é exibida
    die("Conexão falhou: " . $conn->connect_error);
}

// Captura os dados enviados pela URL, por exemplo: login.php?user=admin&pass=123
$username = $_GET['user'];
$password = $_GET['pass'];

// ⚠️ ATENÇÃO: Aqui está a falha de segurança!
// Os dados do usuário estão sendo inseridos diretamente na consulta SQL sem validação ou proteção
// Isso permite que alguém mal-intencionado insira comandos SQL (SQL Injection)
$sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";

// Executa a consulta SQL
$result = $conn->query($sql);

// Verifica se o resultado da consulta retornou algum usuário
if ($result->num_rows > 0) {
    // Se retornou, o login é considerado bem-sucedido
    echo "Login bem-sucedido!";
} else {
    // Caso contrário, o login falha
    echo "Usuário ou senha inválidos!";
}

// Fecha a conexão com o banco de dados
$conn->close();


// Esse código é vulnerável porque permite que o usuário insira comandos SQL diretamente pela URL.
// Esse ataque pode fazer com que o login funcione sem precisar da senha real. Para corrigir, você pode usar prepared statements (consultas preparadas), que protegem contra injeção de SQL.

?>
