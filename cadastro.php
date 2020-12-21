	<?php session_start(); ?>
<!DOCTYPE html>
<html lang="pt-br" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Cadastro de Jogos</title>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
		<script src="vendor/components/jquery/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.3/js/tether.min.js"></script>
		<script src="vendor/twbs/bootstrap/dist/js/bootstrap.min.js"></script>
  </head>
  <body>
    <h1 class="jumbotron bg-info">Cadastro de Jogos</h1>

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
    if(isset($_SESSION['erros'])) {
      $erros = unserialize($_SESSION['erros']);
      foreach($erros as $erro) {
        echo "<br>".$erro;
      }
      unset($_SESSION['erros']);
    }
    ?>

    <form name="cadJogo" id="cadJogo" method="post"action="cadastro.php">

      <div class="form-group">
        <input type="text" name="nomeJogo" placeholder="Nome do Jogo" class="form-control" pattern="^[A-zÁ-ùü ]{2,30}$">
      </div>

      <div class="form-group">
        <input type="text" name="produtoraJogo" placeholder="Nome da produtora do jogo" class="form-control" pattern="^[A-zÁ-ùü ]{2,30}$">
      </div>

      <div class="form-group">
        <input type="text" name="valorJogo" placeholder="Valor do jogo" class="form-control" pattern="^[0-9]{1,3},[0-9]{2}$">
      </div>

      <div class="form-group">
        <input type="text" name="anoLancamento" placeholder="Ano de lançamento" class="form-control" pattern="^[0-9]{4}$">
      </div>

      <div class="form-group">
        <label>Genero do jogo</label>
          <select name="generoJogo" class="form-control">
            <option value="Ação">Ação</option>
            <option value="FPS">FPS</option>
            <option value="MMORPG">MMORPG</option>
            <option value="Terror">Terror</option>
            <option value="Aventura">Aventura</option>
          </select>
        </div>

      <div class="form-group">
        <input type="radio" name="suporteControle" value="Suporta controle">Suporta controle.
			</div>
			<div class="form-group">
        <input type="radio" name="suporteControle" value="Não suporta controle">Não suporta controle.
      </div>

      <div>
      <input type="submit" name="cadastrar" value="cadastrar">
			<input type="submit" value="reset">
      </div>
    </form>
		<?php
		  if(isset($_POST['cadastrar'])) {
				include "modelo/jogo.class.php";
				include "dao/jogodao.class.php";
				include "util/validacao.class.php";
				include "util/padronizacao.class.php";

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

				if(!Validacao::validarGeneroJogo($_POST['generoJogo'])){
	        $contador++;
	      }

				if(!Validacao::validarSuporteControle($_POST['suporteControle'])){
	        $contador++;
	      }

				if($contador!=0) {
				  header("location:erro.php?erro=Erro, dado(s) invalido(s)!");
				  die();
				}


				$jogo = new Jogo();
				$jogo->nomeJogo = Padronizacao::padronizarNome($_POST['nomeJogo']);
				$jogo->produtoraJogo = Padronizacao::padronizarNome($_POST['produtoraJogo']);
				$jogo->valorJogo = $_POST['valorJogo'];
				$jogo->anoLancamento = $_POST['anoLancamento'];
				$jogo->generoJogo = $_POST['generoJogo'];
				$jogo->suporteControle = Padronizacao::padronizarNome($_POST['suporteControle']);

				$jogoDAO = new JogoDAO();
				$jogoDAO->cadastrarJogo($jogo);

				echo $jogo;

				header("location:consulta.php");
			}


		 ?>
  </body>
</html>
