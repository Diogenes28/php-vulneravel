<?php
// login.php com SQL Injection
$conn = new mysqli("localhost", "root", "", "usuarios");

if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

$username = $_GET['user'];
$password = $_GET['pass'];

$sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "Login bem-sucedido!";
} else {
    echo "Usuário ou senha inválidos!";
}

$conn->close();
?>
