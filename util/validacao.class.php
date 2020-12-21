<?php
class Validacao
{

  public static function validarNome($valor): bool
  {
    $expressaoRegular = "/^[A-zÁ-ùü ]{2,30}$/";
    return preg_match($expressaoRegular, $valor);
  }

  public static function validarValor($valor): bool
  {
    $expressaoRegular = "/^[0-9]{1,3},[0-9]{2}$/";
    return preg_match($expressaoRegular, $valor);
  }

  public static function validarAno($valor): bool
  {
    $expressaoRegular = "/^[0-9]{4}$/";
    return preg_match($expressaoRegular, $valor);
  }

  public static function validarCep($valor): bool
  {
    $expressaoRegular = "/^[0-9]{8}$/";
    return preg_match($expressaoRegular, $valor);
  }

  public static function validarIdade($valor): bool
  {
    $expressaoRegular = "/^[0-9]{2,3}$/";
    return preg_match($expressaoRegular, $valor);
  }

  public static function validarRegistroGeral($valor): bool
  {
    $expressaoRegular = "/^[0-9]{11}$/";
    return preg_match($expressaoRegular, $valor);
  }

  public static function validarGeneroJogo($valor): bool
  {
    $expressaoRegular = "/^(Ação|FPS|MMORPG|Terror|Aventura)$/";
    return preg_match($expressaoRegular, $valor);
  }

  public static function validarSuporteControle($valor): bool
  {
    $expressaoRegular = "/^(Suporta controle|Não suporta controle)$/";
    return preg_match($expressaoRegular, $valor);
  }

  public static function validarSexo($valor): bool
  {
    $expressaoRegular = "/^(M|F|m|f|Masc|Fem|masc|fem|Masculino|Feminino|masculino|feminino)$/";
    return preg_match($expressaoRegular, $valor);
  }


}
