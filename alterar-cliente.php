<!DOCTYPE html>
<html lang="pt-br" dir="ltr">
<head>
<meta charset="utf-8">
<title>Alterar cliente</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<script src="vendor/components/jquery/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.3/js/tether.min.js"></script>
<script src="vendor/twbs/bootstrap/dist/js/bootstrap.min.js"></script>
</head>
<body>
  <h1 class="jumbotron bg-info">Alterar cliente</h1>

  <?php
  if(isset($_GET['id'])) {
    include 'dao/clientedao.class.php';
    include 'modelo/cliente.class.php';
    // echo "<br>".$_GET['id'];
    $clienteDAO = new ClienteDAO();
    $array = $clienteDAO->filtrar($_GET['id'], "codigo");
    $cliente = $array[0];
     // echo "<br>".$cliente;
  }
  ?>
  <form name="cad" method="post" action="alterar-cliente.php">

    <div class="form-group">
      <!-- readonly hidden -->
      <input type="text" name="idCliente"
            class="form-control" placeholder="Código do cliente"
      value="<?php if(isset($cliente)) echo $cliente->idCliente; ?>">
    </div>
    <div class="form-group">
      <input type="text" name="nomeCliente"
            class="form-control" pattern="^[A-zÁ-ùü ]{2,30}$" placeholder="Digite o nome do cliente" autofocus
             autofocus value="<?php if(isset($cliente))  echo $cliente->nomeCliente; ?>">
    </div>
    <div class="form-group">
      <input type="text" name="sobrenomeCliente"
            class="form-control" pattern="^[A-zÁ-ùü ]{2,30}$"  placeholder="Digite o nome do cliente"
             value="<?php if(isset($cliente))  echo $cliente->sobrenomeCliente; ?>">
    </div>
    <div class="form-group">
      <input type="number" name="idadeCliente"
            class="form-control" pattern="^[0-9]{2,3}$"  placeholder="Digite a idade do cliente"
             value="<?php  if(isset($cliente)) echo $cliente->idadeCliente; ?>">
    </div>

    <div class="form-group">
      <input type="text" name="sexoCliente"
            class="form-control" pattern="^(M|F|m|f|Masc|Fem|masc|fem|Masculino|Feminino|masculino|feminino)$" placeholder="Digite o sexo do cliente"
             value="<?php if(isset($cliente)) echo $cliente->sexoCliente; ?>">
    </div>

    <div class="form-group">
      <input type="text" name="registroGeral"
            class="form-control" pattern="^[0-9]{11}$" placeholder="Digite o RG do cliente"
             value="<?php if(isset($cliente)) echo $cliente->registroGeral; ?>">
    </div>

    <div class="form-group">
      <input type="text" name="cep"
            class="form-control" pattern="^[0-9]{8}$" placeholder="Digite o CEP do cliente"
             value="<?php if(isset($cliente)) echo $cliente->cep; ?>">
    </div>

    <div>
      <input type="submit" name="alterar" value="Alterar">
    </div>
  </form>

  <?php
  if(isset($_POST['alterar'])) {
    include 'modelo/cliente.class.php';
    include 'dao/clientedao.class.php';
    include 'util/padronizacao.class.php';
    include 'util/validacao.class.php';

    $contador = 0;
    if(!Validacao::validarNome($_POST['nomeCliente'])){
      $contador++;
    }

    if(!Validacao::validarNome($_POST['sobrenomeCliente'])){
      $contador++;
    }

    if(!Validacao::validarIdade($_POST['idadeCliente'])){
      $contador++;
    }

    if(!Validacao::validarRegistroGeral($_POST['registroGeral'])){
      $contador++;
    }

    if(!Validacao::validarCep($_POST['cep'])){
      $contador++;
    }

    if($contador!=0) {
      header("location:erro.php?erro=Erro, dado(s) invalido(s)!");
      die();
    }


    $cliente = new Cliente();
    $cliente->nomeCliente = $_POST['nomeCliente'];
    $cliente->sobrenomeCliente = $_POST['sobrenomeCliente'];
    $cliente->idadeCliente = $_POST['idadeCliente'];
    $cliente->sexoCliente = $_POST['sexoCliente'];
    $cliente->registroGeral = $_POST['registroGeral'];
    $cliente->cep = $_POST['cep'];
    //nao esquecerr de enviar o ID para o alterar!!!!!
    $cliente->idCliente = $_POST['idCliente'];
    $clienteDAO = new ClienteDAO();
    $clienteDAO->alterarCliente($cliente);
    // echo $cliente;
    header("location:consulta-cliente.php");
    unset($_POST['alterar']);
    unset($_GET['id']);
    unset($cliente);
  }
  ?>
</body>
</html>
