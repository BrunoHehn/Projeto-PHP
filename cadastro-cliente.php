<!DOCTYPE html>
<html lang="pt-br" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Cadastro CLiente</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="vendor/components/jquery/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.3/js/tether.min.js"></script>
    <script src="vendor/twbs/bootstrap/dist/js/bootstrap.min.js"></script>
  </head>
  <body>
    <h1 class="jumbotron bg-info">Cadastro de Cliente</h1>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
          <a class="navbar-brand" href="#">Sistema</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item active">
            <a class="nav-link" href="index.php">Home</a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="cadastro.php">Cad. Jogos</a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="consulta.php">Cons. Jogos <span class="sr-only">(current)</span></a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="cadastro-cliente.php">Cad. cliente</a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="consulta-cliente.php">Cons. cliente <span class="sr-only">(current)</span></a>
          </li>
        </ul>
      </div>
    </nav>

    <form name="cad"  method="post" action="cadastro-cliente.php">

    <div class="form-group">
    <input type="text" name="nomeCliente" class="form-control" pattern="^[A-zÁ-ùü ]{2,30}$" placeholder="Digite o nome do cliente">
    </div>

    <div class="form-group">
      <input type="text" name="sobrenomeCliente" class="form-control" pattern="^[A-zÁ-ùü ]{2,30}$" placeholder="Digite o sobrenome do cliente">
    </div>

    <div class="form-group">
      <input type="text" name="idadeCliente" class="form-control" pattern="^[0-9]{2,3}$" placeholder="Digite a idade do cliente">
    </div>

    <div class="form-group">
      <input type="text" name="sexoCliente" class="form-control" pattern="^(M|F|m|f|Masc|Fem|masc|fem|Masculino|Feminino|masculino|feminino)$" placeholder="Digite o sexo do cliente">
    </div>

    <div class="form-group">
      <input type="text" name="registroGeral" class="form-control" pattern="^[0-9]{11}$" placeholder="Digite o RG do cliente">
    </div>

    <div class="form-group">
      <input type="text" name="cep" class="form-control" pattern="^[0-9]{8}$" placeholder="Digite o CEP do cliente">
    </div>

    <div>
      <input type="submit" name="cadastrar" value="Cadastrar">
      <input type="reset" value="Limpar">
    </div>

    </form>
    <?php
    if(isset($_POST['cadastrar'])) {
      include "modelo/cliente.class.php";
      include "dao/clientedao.class.php";
      include "util/validacao.class.php";
      include "util/padronizacao.class.php";

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

      if(!Validacao::validarSexo($_POST['sexoCliente'])){
        $contador++;
      }

      if($contador!=0) {
        header("location:erro.php?erro=Erro, dado(s) invalido(s)!");
        die();
      }

      $cliente = new Cliente();

      $cliente->nomeCliente = Padronizacao::padronizarNome($_POST['nomeCliente']);
      $cliente->sobrenomeCliente = Padronizacao::PadronizarNome($_POST['sobrenomeCliente']);
      $cliente->idadeCliente = $_POST['idadeCliente'];
      $cliente->sexoCliente = $_POST['sexoCliente'];
      $cliente->registroGeral = $_POST['registroGeral'];
      $cliente->cep = $_POST['cep'];

      $clienteDAO = new ClienteDAO();
      $clienteDAO->cadastrarCliente($cliente);

      echo $cliente;

      header("location:consulta-cliente.php");
      }
     ?>
  </body>
</html>
