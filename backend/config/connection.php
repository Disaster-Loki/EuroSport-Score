<?php
$host = "localhost";
$db = "EuroSportScore";
$port = "3306";
$user = "root";
$pass = "";

try
{
    $conn = new PDO("mysql:host=$host;port=$port;dbname=$db", $user, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conn->exec("USE $db");
}
catch(PDOException $e)
{
    echo "Erro na conexao " . $e->getMessage();;
}

?>