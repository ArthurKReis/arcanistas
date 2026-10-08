<?php
$host = 'localhost';
$dbname = 'arcanistas';
$username = 'root';
$password = '';

$conn = new mysqli($host, $username, $password);
if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
    }
    $sql = "CREATE DATABASE IF NOT EXISTS arcanistas;";
    if ($conn->query($sql) === FALSE){
        $message = "Erro na criação do banco de dados: ";
        echo "<script type='text/javascript'>alert('$message . $conn->error');</script>";
    }
$conn->close();

$conn = mysqli_connect($host, $username, $password, $dbname);
mysqli_set_charset($conn,"utf8");
    if(!$conn) {
        die('Unable to connect to database'.mysqli_connect_error());
    }
$query = file_get_contents("crdb.sql", true);
    if (!mysqli_multi_query($conn, $query)){

        $message = "Fail";
        echo "<script type='text/javascript'>alert('$message');</script>";
    }
$conn->close();

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Erro na conexão: " . $e->getMessage());
}
?>