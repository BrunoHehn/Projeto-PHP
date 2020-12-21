<?php
require "conexaobanco.class.php";
class JogoDAO
{ //DAO - data access object - acesso aos dados do objeto

  private $conexao = null;

  public function __construct()
  {
    $this->conexao = ConexaoBanco::getInstance();
  }

  public function __destruct()
  {
  }

  public function cadastrarJogo($jogo) //objeto livro
  {
    try {
      $statement = $this->conexao->prepare(
        "INSERT into jogo(idjogo,nomeJogo,produtoraJogo,valorJogo,
        anoLancamento,generoJogo,suporteControle) values(null,?,?,?,?,?,?)"); //BINDVALUES - SQLINJECTION

      $statement->bindValue(1,$jogo->nomeJogo);
      $statement->bindValue(2,$jogo->produtoraJogo);
      $statement->bindValue(3,$jogo->valorJogo);
      $statement->bindValue(4,$jogo->anoLancamento);
      $statement->bindValue(5,$jogo->generoJogo);
      $statement->bindValue(6,$jogo->suporteControle);

      $statement->execute();
    } catch(PDOException $error) {
      echo "Erro ao cadastrar livro!".$error;
    }
  }

  public function buscarJogos()
  {
    try {
      $statement = $this->conexao->query("select * from jogo");
      $array = $statement->fetchAll(PDO::FETCH_CLASS, 'Jogo');
      return $array;
    } catch(PDOException $error) {
      echo "Erro ao buscar Jogo!".$error;
    }
  }

  public function filtrar($pesquisa, $filtro)
{
  try {
    $query = "";
    switch($filtro) {
      case "codigo": $query = "where idJogo = ".$pesquisa;
      break;
      case "nomeJogo": $query = "where nomeJogo like '%".$pesquisa."%'";
      break;
      case "produtoraJogo": $query = "where produtoraJogo like '%".$pesquisa."%'";
      break;
      case "valorJogo": $query = "where valorjogo like '%".$pesquisa."%'";
      break;
      case "anolancamento": $query = "where anolancamento like '%".$pesquisa."%'";
      break;
      case "generoJogo": $query = "where generoJogo like '%".$pesquisa."%'";
      break;
      case "suporteControle": $query = "where suporteControle like '%".$pesquisa."%'";
      break;
      default: $query = "";
      break;
    }
    if(empty($pesquisa)) {
      $query = "";
    }
    $statement = $this->conexao->query("select * from jogo {$query}");
    $array = $statement->fetchAll(PDO::FETCH_CLASS, 'Jogo');
    return $array;
  } catch(PDOException $error) {
    echo "Erro ao filtrar!".$error;
  }
}

  public function deletarJogo($id)
  {
  try {
    $statement = $this->conexao->prepare(
      "delete from jogo where idjogo = ?");
    $statement->bindValue(1, $id);
    $statement->execute();
  } catch(PDOException $error) {
    echo "Erro ao deletar! ".$error;
  }
 }

 public function alterarJogo($jogo)
 {
  try {
    $statement = $this->conexao->prepare("update jogo set nomejogo=?, produtoraJogo=?, valorjogo=?, anolancamento=?, generojogo=?, suportecontrole=? where idjogo=?");
    $statement->bindValue(1,$jogo->nomeJogo);
    $statement->bindValue(2,$jogo->produtoraJogo);
    $statement->bindValue(3,$jogo->valorJogo);
    $statement->bindValue(4,$jogo->anoLancamento);
    $statement->bindValue(5,$jogo->generoJogo);
    $statement->bindValue(6,$jogo->suporteControle);
    $statement->bindValue(7,$jogo->idJogo);
    $statement->execute();
  } catch(PDOException $error) {
    echo "Erro ao alterar livro!".$error;
  }
 }
}
