<?php
class jogo{

  private $idJogo;
  private $nomeJogo;
  private $produtoraJogo;
  private $valorJogo;
  private $anoLancamento;
  private $generoJogo;
  private $suporteControle;

  public function __construct()
  {
  }

  public function __destruct()
  {
  }

  public function __get($atributo)
  {
    return $this->$atributo;
  }

  public function __set($atributo, $valor)
  {
    $this->$atributo = $valor;
  }

  public function __toString()
  {
    return nl2br ("Nome do jogo: $this->nomeJogo
                   Produtora do jogo: $this->produtoraJogo
                   Valor do jogo: $this->valorJogo
                   Ano do Lançamento: $this->anoLancamento
                   Genero do Jogo: $this->generoJogo
                   Suporte Controle: $this->suporteControle
                   ");
  }

}
