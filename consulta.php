<?php ob_start(); ?>
<!DOCTYPE html>
<html lang="pt-br" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Consulta de Jogo</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="vendor/components/jquery/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.3/js/tether.min.js"></script>
    <script src="vendor/twbs/bootstrap/dist/js/bootstrap.min.js"></script>
  </head>
  <body>
    <h1 class="jumbotron bg-info">Consulta de jogo</h1>

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
    include 'dao/jogodao.class.php';
    include 'modelo/jogo.class.php';
    $jogoDAO = new JogoDAO();
    $jogos = $jogoDAO->buscarJogos();
    // para teste
    // var_dump($jogos);
    if(count($jogos) == 0) {
      echo "<h1>Não há jogos cadastrados</h1>";
      return;
    }
    ?>
    <form name="filtrar" method="post" action="consulta.php">
          <div class="row">
            <div class="form-group col-md-6">
              <input type="text" name="txtfiltro"
                     placeholder="Digite a sua pesquisa" class="form-control">
            </div>

            <div class="form-group col-md-6">
              <select name="selfiltro" class="form-control">
                <option value="todos">Todos</option>
                <option value="codigo">Código</option>
                <option value="nomeJogo">Nome</option>
                <option value="produtoraJogo">Produtora</option>
                <option value="valorJogo">Valor</option>
                <option value="anolancamento">Ano lançamento</option>
                <option value="generoJogo">Gênero</option>
                <option value="suporteControle">Suporte a controle</option>
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
        $jogDAO = new JogoDAO();
        $jogos = $jogDAO->filtrar($pesquisa,$filtro);

        if(count($jogos) == 0){
          echo "<h3>Sua pesquisa não retornou nenhum Jogo!</h3>";
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
          echo "<th>Nome do Jogo</th>";
          echo "<th>Produtora</th>";
          echo "<th>Valor</th>";
          echo "<th>ano de lançamento</th>";
          echo "<th>Gênero</th>";
          echo "<th>Suporte controle</th>";
          echo "<th>Alterar</th>";
          echo "<th>Excluir</th>";
        echo "</tr>";
      echo "</thead>";

      echo "<tfoot>";
      echo "<tr>";
        echo "<th>Código</th>";
        echo "<th>Nome do Jogo</th>";
        echo "<th>Produtora</th>";
        echo "<th>Valor</th>";
        echo "<th>ano de lançamento</th>";
        echo "<th>Gênero</th>";
        echo "<th>Suporte controle</th>";
        echo "<th>Alterar</th>";
        echo "<th>Excluir</th>";
      echo "</tr>";
      echo "</tfoot>";
      echo "<tbody>";
    foreach($jogos as $jogo) {
      echo "<tr>";
        echo "<td>$jogo->idJogo</td>";
        echo "<td>$jogo->nomeJogo</td>";
        echo "<td>$jogo->produtoraJogo</td>";
        echo "<td>$jogo->valorJogo</td>";
        echo "<td>$jogo->anoLancamento</td>";
        echo "<td>$jogo->generoJogo</td>";
        echo "<td>$jogo->suporteControle</td>";

      echo "<td><a class='btn btn-warning' href='alterar.php?id={$jogo->idJogo}'>Alterar</a></td>";
      echo "<td><a class='btn btn-danger' href='consulta.php?id={$jogo->idJogo}'>Excluir</a></td>";
      echo "</tr>";
    }
    echo "</tbody>";
    echo "</table>";
    echo "</div>"; //table responsive
    ?>
  </body>
</html>

<?php
//excluir
if(isset($_GET['id'])) {
  $jogoDAO->deletarJogo($_GET['id']);
  header("location:consulta.php");
  unset($_GET['id']);
}
?>
