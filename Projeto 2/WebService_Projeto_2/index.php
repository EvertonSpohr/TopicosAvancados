<?php

require '../Slim/Slim/Slim.php';
\Slim\Slim::registerAutoloader();
$app = new \Slim\Slim();
$app->response()->header('Content-Type', 'application/json;charset=utf-8');

$app->get('/', function () {
  echo "Trabalho de Topicos Avançados - Web Service Detran - Projeto 2";
});

$app->get('/multas/:renavam','getMultas');
$app->get('/infracoes/:renavam','getInfracoes');
$app->get('/dividas/:renavam','getAll');

$app->run();

function getConn()
{
 return new PDO('mysql:host=localhost:3307; dbname=Projeto2','root','spohr', array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8")
  
  );

}

function getMultas($renavam)
{
  $conn = getConn();
  $sql = "SELECT * FROM Multas WHERE Carro_Renavam = :renavam";
  $stmt = $conn->prepare($sql);
  $stmt->bindParam("renavam",$renavam);
  $stmt->execute();
  $Multas = $stmt->fetchObject();
  
  echo json_encode($Multas);
}

function getInfracoes($renavam)
{
  $conn = getConn();
  $sql = "SELECT * FROM infracoes WHERE Carro_Renavam = :renavam";
  $stmt = $conn->prepare($sql);
  $stmt->bindParam("renavam",$renavam);
  $stmt->execute();
  $infracoes = $stmt->fetchObject();
  
  echo json_encode($infracoes);
}

function getAll($renavam)
{
  $conn = getConn();
  $sql = "SELECT * FROM Multas WHERE Carro_Renavam = :renavam";
  $stmt = $conn->prepare($sql);
  $stmt->bindParam("renavam",$renavam);
  $stmt->execute();
  $Multas = $stmt->fetchObject();
  
  $conn = getConn();
  $sql = "SELECT * FROM infracoes WHERE Carro_Renavam = :renavam";
  $stmt = $conn->prepare($sql);
  $stmt->bindParam("renavam",$renavam);
  $stmt->execute();
  $infracoes = $stmt->fetchObject();
  
  echo json_encode($infracoes);  
  echo json_encode($Multas);
}