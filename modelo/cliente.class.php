<?php
class Cliente {

  private $idCliente;
  private $nomeCliente;
  private $sobrenomeCliente;
  private $idadeCliente;
  private $sexoCliente;
  private $registroGeral;
  private $cep;

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
     return nl2br ("ID: $this->idCliente
                    Nome do Cliente: $this->nomeCliente
                    Sobrenome do Cliente: $this->sobrenomeCliente
                    Idade do Cliente: $this->idadeCliente
                    Sexo: $this->sexoCliente
                    RG do cliente: $this->registroGeral
                    CEP do cliente: $this->cep");
   }
}
