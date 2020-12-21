<!DOCTYPE html>
<html lang="pt-br" dir="ltr">
<head>
<meta charset="utf-8">
<title>Alterar Jogo</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<script src="vendor/components/jquery/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.3/js/tether.min.js"></script>
<script src="vendor/twbs/bootstrap/dist/js/bootstrap.min.js"></script>
</head>
<body>
  <h1 class="jumbotron bg-info">Alterar Jogo</h1>

  <?php
  if(isset($_GET['id'])) {
    include 'dao/jogodao.class.php';
    include 'modelo/jogo.class.php';
    // echo "<br>".$_GET['id'];
    $jogoDAO = new JogoDAO();
    $array = $jogoDAO->filtrar($_GET['id'], "codigo");
    $jogo = $array[0];
      // echo "<br>".$jogo;
  }
  ?>
  <form name="cad" method="post" action="alterar.php">

    <div class="form-group">
      <!-- readonly hidden -->
      <input type="text" name="idJogo" placeholder="Código do jogo" class="form-control" value="<?php if(isset($jogo)) echo $jogo->idJogo; ?>">
    </div>
    <div class="form-group">
      <input type="text" name="nomeJogo" placeholder="Digite o nome do jogo" class="form-control" pattern="^[A-zÁ-ùü ]{2,30}$" autofocus value="<?php if(isset($jogo))  echo $jogo->nomeJogo; ?>">
    </div>
    <div class="form-group">
      <input type="text" name="produtoraJogo" placeholder="Digite a produtora do jogo" class="form-control" pattern="^[A-zÁ-ùü ]{2,30}$" value="<?php if(isset($jogo))  echo $jogo->produtoraJogo; ?>">
    </div>
    <div class="form-group">
      <input type="text" name="valorJogo" placeholder="Digite o valor do jogo" class="form-control" pattern="^[0-9]{1,3},[0-9]{2}$" value="<?php  if(isset($jogo)) echo $jogo->valorJogo; ?>">
    </div>

    <div class="form-group">
      <input type="number" name="anoLancamento" placeholder="Digite o ano de lançamento" class="form-control" pattern="^[0-9]{4}$" value="<?php if(isset($jogo)) echo $jogo->anoLancamento; ?>">
    </div>

    <div class="form-group">
      <label>Genero</label>
      <select name="generoJogo" class="form-control">
        <option value="Ação" <?php if(isset($jogo)) if($jogo->generoJogo=='Ação') echo 'selected=selected'; ?>>Ação</option>
        <option value="FPS" <?php if(isset($jogo))  if($jogo->generoJogo=='FPS') echo 'selected=selected'; ?>>FPS</option>
        <option value="MMORPG" <?php if(isset($jogo)) if($jogo->generoJogo=='MMORPG') echo 'selected=selected'; ?>>MMORPG</option>
        <option value="Terror" <?php if(isset($jogo))  if($jogo->generoJogo=='Terro') echo 'selected=selected'; ?>>Terror</option>
        <option value="Aventura" <?php if(isset($jogo))   if($jogo->generoJogo=='Aventura') echo 'selected=selected'; ?>>Aventura</option>
      </select>
    </div>

    <div class="form-group">
      <input type="radio" name="suporteControle" value="Suporta controle"> <?php if(isset($jogo)) if($jogo->suporteControle=='Suporta controle'); ?>
      <label>Suporta controle</label>
    </div>
    <div class="form-group">
      <input type="radio" name="suporteControle" value="Não suporta controle"> <?php if(isset($jogo)) if($jogo->suporteControle=='Não suporta controle'); ?>
      <label>Não suporta controle</label>
    </div>

    <div>
      <input type="submit" name="alterar" value="Alterar">
    </div>
  </form>

  <?php
  if(isset($_POST['alterar'])) {
    include 'modelo/jogo.class.php';
    include 'dao/jogodao.class.php';
    include 'util/padronizacao.class.php';
    include 'util/validacao.class.php';

    $contador = 0;
    if(!Validacao::validarNome($_POST['nomeJogo'])){
      $contador++;
    }

    if(!Validacao::validarNome($_POST['produtoraJogo'])){
      $contador++;
    }

    if(!Validacao::validarValor($_POST['valorJogo'])){
      $contador++;
    }

    if(!Validacao::validarAno($_POST['anoLancamento'])){
      $contador++;
    }


    if($contador!=0) {
      header("location:erro.php?erro=Erro, dado(s) invalido(s)!");
      die();
    }

    $jogo = new Jogo();
    $jogo->idJogo = $_POST['idJogo'];
    $jogo->nomeJogo = Padronizacao::padronizarNome($_POST['nomeJogo']);
    $jogo->produtoraJogo = Padronizacao::padronizarNome($_POST['produtoraJogo']);
    $jogo->valorJogo = $_POST['valorJogo'];
    $jogo->anoLancamento = $_POST['anoLancamento'];
    $jogo->generoJogo = $_POST['generoJogo'];
    $jogo->suporteControle = Padronizacao::padronizarNome($_POST['suporteControle']);
    //nao esquecerr de enviar o ID para o alterar!!!!!

    $jogoDAO = new JogoDAO();
    $jogoDAO->alterarJogo($jogo);
      // echo "<br>".$jogo;
    header("location:consulta.php");
    unset($_POST['alterar']);
    unset($_GET['id']);
    unset($jogo);
  }
  ?>
</body>
</html>
