<?php

include("./connection.php");
include("./model/ModelPessoa.php");

$conn = new Connection();
$modelPessoa = new ModelPessoa($conn->returnConnection());

$dados = $modelPessoa->findAll();

echo '<pre>';
var_dump($dados);
echo '</pre>';

?>