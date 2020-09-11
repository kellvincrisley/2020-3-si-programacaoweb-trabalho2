<?php

require_once(__DIR__ . '/../../db/Db.php');
require_once(__DIR__ . '/../../model/Loja.php');
require_once(__DIR__ . '/../../dao/DaoLoja.php');
require_once(__DIR__ . '/../../config/config.php');

$conn = Db::getInstance();

if (! $conn->connect()) {
    die();
}

$daoLoja = new DaoLoja($conn);
$daoLoja->inserir( new Loja($_POST['nome_fantasia'],$_POST['endereco'],$_POST['telefone'],$_POST['cnpj'],$_POST['cep']));
    
header('Location: ./index.php');

?>


