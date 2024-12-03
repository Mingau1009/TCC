<?php

include("../../Classe/Conexao.php");

$nome = isset($_POST["name"]) ? $_POST["name"] : NULL;
$data_nascimento = isset($_POST["sdate"]) ? $_POST["sdate"] : NULL;
$telefone = isset($_POST["telefone"]) ? $_POST["telefone"] : NULL;
$endereco = isset($_POST["address"]) ? $_POST["address"] : NULL;
$frequencia = isset($_POST["frequency"]) ? $_POST["frequency"] : NULL;
$objetivo = isset($_POST["Objective"]) ? $_POST["Objective"] : NULL;
$data_matricula = isset($_POST["sDate"]) ? $_POST["sDate"] : NULL;

$sql = ("INSERT INTO `aluno` 
    (
        `nome`, 
        `data_nascimento`, 
        `telefone`, 
        `endereco`, 
        `frequencia`, 
        `objetivo`, 
        `data_matricula`
    ) 
    VALUES 
    (
        :nome,
        :data_nascimento,
        :telefone,
        :endereco,
        :frequencia,
        :objetivo,
        :data_matricula
)");

$executar = Db::conexao()->prepare($sql);

$executar->bindValue(":nome", $nome, PDO::PARAM_STR);
$executar->bindValue(":data_nascimento", $data_nascimento, PDO::PARAM_STR);
$executar->bindValue(":telefone", $telefone, PDO::PARAM_STR);
$executar->bindValue(":endereco", $endereco, PDO::PARAM_STR);
$executar->bindValue(":frequencia", $frequencia, PDO::PARAM_INT);
$executar->bindValue(":objetivo", $objetivo, PDO::PARAM_STR);
$executar->bindValue(":data_matricula", $data_matricula, PDO::PARAM_STR);

$executar->execute();

header("Location: index.php");