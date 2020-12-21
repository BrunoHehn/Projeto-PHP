<!DOCTYPE html>
<html lang="pt-br" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Consulta de clientes</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="vendor/components/jquery/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.3/js/tether.min.js"></script>
    <script src="vendor/twbs/bootstrap/dist/js/bootstrap.min.js"></script>
  </head>
  <body>
    <h1 class="jumbotron bg-info">Consulta de clientes</h1>

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

    <?php
    include 'dao/clientedao.class.php';
    include 'modelo/cliente.class.php';
    $clienteDAO = new ClienteDAO();
    $clientes = $clienteDAO->buscarClientes();
    // para teste
    // var_dump($livros);

    if(count($clientes) == 0) {
      echo "<h1>Não há clientes cadastrados</h1>";
      return;
    }
    ?>
    <form name="filtrar" method="post" action="consulta-cliente.php">
          <div class="row">
            <div class="form-group col-md-6">
              <input type="text" name="txtfiltro"
                     placeholder="Digite a sua pesquisa" class="form-control">
            </div>

            <div class="form-group col-md-6">
              <select name="selfiltro" class="form-control">
                <option value="todos">Todos</option>
                <option value="codigo">Código</option>
                <option value="nomeCliente">Nome</option>
                <option value="sobrenomeCliente">Sobrenome</option>
                <option value="idadeCliente">Idade</option>
                <option value="sexoCliente">Sexo</option>
                <option value="registroGeral">RG</option>
                <option value="cep">CEP</option>
              </select>
            </div>
          </div> <!-- fecha row -->

          <div class="form-group">
            <input type="submit" name="filtrar" value="Filtrar" class="btn btn-primary btn-block">
          </div>
        </form>
<?php
    if(isset($_POST['filtrar'])){
      $pesquisa = $_POST['txtfiltro'];
      $filtro = $_POST['selfiltro'];

      if(!empty($pesquisa)){
        $clieDAO = new ClienteDAO();
        $clientes = $clieDAO->filtrar($pesquisa,$filtro);

        if(count($clientes) == 0){
          echo "<h3>Sua pesquisa não retornou nenhum Cliente!</h3>";
          return;
        }

      }
    }//fecha if
    ?>

    <?php
    echo "<div class='table-responsive'>";
      echo "<table class='table table-striped table-bordered table-hover table-condensed'>";
      echo "<thead>";
        echo "<tr>";
          echo "<th>Código</th>";
          echo "<th>Nome</th>";
          echo "<th>Sobrenome</th>";
          echo "<th>Idade</th>";
          echo "<th>Sexo</th>";
          echo "<th>registroGeral</th>";
          echo "<th>CEP</th>";
          echo "<th>Alterar</th>";
          echo "<th>Excluir</th>";
        echo "</tr>";
      echo "</thead>";

      echo "<tfoot>";
      echo "<tr>";
        echo "<th>Código</th>";
        echo "<th>Nome</th>";
        echo "<th>Sobrenome</th>";
        echo "<th>Idade</th>";
        echo "<th>Sexo</th>";
        echo "<th>registroGeral</th>";
        echo "<th>CEP</th>";
        echo "<th>Alterar</th>";
        echo "<th>Excluir</th>";
      echo "</tr>";
      echo "</tfoot>";
      echo "<tbody>";
    foreach($clientes as $cliente) {
      echo "<tr>";
      echo "<td>$cliente->idCliente</td>";
      echo "<td>$cliente->nomeCliente</td>";
      echo "<td>$cliente->sobrenomeCliente</td>";
      echo "<td>$cliente->idadeCliente</td>";
      echo "<td>$cliente->sexoCliente</td>";
      echo "<td>$cliente->registroGeral</td>";
      echo "<td>$cliente->cep</td>";
      echo "<td><a class='btn btn-warning' href='alterar-cliente.php?id={$cliente->idCliente}'>Alterar</a></td>";
      echo "<td><a class='btn btn-danger' href='consulta-cliente.php?id={$cliente->idCliente}'>Excluir</a></td>";
      echo "</tr>";
    }
    echo "</tbody>";
    echo "</table>";
    echo "</div>";

    ?>
  </body>
</html>

<?php
if(isset($_GET['id'])) {
  $clienteDAO->deletarCliente($_GET['id']);
  header("location:consulta-cliente.php");
  unset($_GET['id']);
}
?>
