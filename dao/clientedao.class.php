<?php
require "conexaobanco.class.php";
class ClienteDAO
{

  private $conexao = null;

  public function __construct()
  {
    $this->conexao = ConexaoBanco::getInstance();
  }

  public function __destruct()
  {
  }

  public function cadastrarCliente($cliente)
  {
    try {
      $statement = $this->conexao->prepare(
           "insert into cliente(idcliente,nomecliente,sobrenomecliente,idadecliente,
           sexocliente,registrogeral,cep) values(null,?,?,?,?,?,?)"); //BINDVALUES - SQLINJECTION

        $statement->bindValue(1,$cliente->nomeCliente);
        $statement->bindValue(2,$cliente->sobrenomeCliente);
        $statement->bindValue(3,$cliente->idadeCliente);
        $statement->bindValue(4,$cliente->sexoCliente);
        $statement->bindValue(5,$cliente->registroGeral);
        $statement->bindValue(6,$cliente->cep);
        $statement->execute();
    } catch (PDOException $error) {
      echo "Erro ao cadastrar cliente!" .$error;
    }
  }

  public function buscarClientes()
  {
  try {
    $statement = $this->conexao->query("select * from cliente");
    $array = $statement->fetchAll(PDO::FETCH_CLASS, 'Cliente');
    return $array;
  } catch(PDOException $error) {
    echo "Erro ao buscar clientes!".$error;
  }
 }

 public function filtrar($pesquisa, $filtro)
{
  try {
    $query = "";
    switch($filtro) {
      case "codigo": $query = "where idcliente = ".$pesquisa;
      break;
      case "nomeCliente": $query = "where nomeCliente like '%".$pesquisa."%'";
      break;
      case "sobrenomeCliente": $query = "where sobrenomeCliente like '%".$pesquisa."%'";
      break;
      case "idadeCliente": $query = "where idadeCliente like '%".$pesquisa."%'";
      break;
      case "sexoCliente": $query = "where sexoCliente like '%".$pesquisa."%'";
      break;
      case "registroGeral": $query = "where registroGeral like '%".$pesquisa."%'";
      break;
      case "cep": $query = "where cep like '%".$pesquisa."%'";
      break;
      default: $query = "";
      break;
    }
    if(empty($pesquisa)) {
      $query = "";
    }
    $statement = $this->conexao->query("select * from cliente {$query}");
    $array = $statement->fetchAll(PDO::FETCH_CLASS, 'Cliente');
    return $array;
  } catch(PDOException $error) {
    echo "Erro ao filtrar!".$error;
  }
 }

  public function deletarCliente($id)
  {
    try {
      $statement = $this->conexao->prepare("delete from cliente where idcliente = ?");
      $statement->bindValue(1, $id);
      $statement->execute();
    } catch(PDOException $error) {
      echo "Erro ao deletar! ".$error;
    }
  }

 public function alterarCliente($cliente)
 {
  try {
    $statement = $this->conexao->prepare("update cliente set nomeCliente=?, sobrenomeCliente=?, idadeCliente=?, sexoCliente=?, registroGeral=?, cep=? where idCliente=?");
    $statement->bindValue(1,$cliente->nomeCliente);
    $statement->bindValue(2,$cliente->sobrenomeCliente);
    $statement->bindValue(3,$cliente->idadeCliente);
    $statement->bindValue(4,$cliente->sexoCliente);
    $statement->bindValue(5,$cliente->registroGeral);
    $statement->bindValue(6,$cliente->cep);
    $statement->bindValue(7,$cliente->idCliente);
    $statement->execute();
  } catch(PDOException $error) {
    echo "Erro ao alterar Cliente!".$error;
  }
 }
}
