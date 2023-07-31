<?php
require_once("../connMySQL.php");
$name = $_REQUEST['name'];
$sql = $pdo->prepare("SELECT * FROM images WHERE name = '$name'");
$sql->execute();
$row = $sql->fetch(PDO::FETCH_ASSOC);

header("Content-Type: ".$row["type"]);

echo $row['data'];
