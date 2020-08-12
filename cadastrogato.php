<?php  session_start();?>
<!DOCTYPE html>
<html lang="pt-br" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="vendor/components/jquery/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.3/js/tether.min.js"></script>
    <script src="vendor/twbs/bootstrap/dist/js/bootstrap.min.js"></script>
    <title>Cadastro</title>
  </head>
  <body>
    <h1 class="jumbotron bg-info">Cadastro Gatos</h1>

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
                <a class="nav-link" href="cadastrogato.php">Cadastro Gatos</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="consultagato.php">Consultar Gatos <span class="sr-only">(current)</span></a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="cadastrocao.php">Cadastro Cão</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="consultacao.php">Consultar Cão <span class="sr-only">(current)</span></a>
              </li>
            </ul>
          </div>
        </nav>

        <h2 class="jumbotron bg-info">Formulário Gato</h2>

        <?php
        if(isset($_SESSION['erros']))
        {
          $erros = unserialize($_SESSION['erros']);
          foreach($erros as $erro) {
            echo "<hr>$erro";
          }
          unset($_SESSION['erros']);
        }
        ?>

       <form name="cad" method="post" action="cadastrogato.php">
        <div class="form-group">
         <input type="text" name="nomeGato" placeholder="Digite o nome do gato" autofocus class="form-control">
        </div>
        <div class="form-group">
         <input type="text" name="racaGato" placeholder="Digite a raça do gato" class="form-control">
        </div>
        <div class="form-group">
          <label>Selecione o sexo do gato</label>
          <select name="sexoGato" class="form-control">
            <option value="Macho">Macho</option>
            <option value="Femia">Fêmia</option>
          </select>
        </div>
        <div class="form-group">
         <input type="text" name="corGato" placeholder="Digite a cor do gato" class="form-control">
        </div>
        <div class="form-group">
         <input type="number" name="idadeGato" placeholder="Digite a idade do gato" class="form-control">
        </div>
        <div class="form-group">
         <input type="number" name="pesoGato" placeholder="Digite o peso do gato" class="form-control">
        </div>
        <div class="form-group">
        <p>O gato ja esta castrado? </p>
        <input type="radio" name="castradoGato" value="Sim" checked>
        <label>Sim</label>
        <input type="radio" name="castradoGato" value="Não">
        <label>Não</label>
        </div>
        <div class="form-group">

          <input type="submit" name="cadastrar" value="Cadastrar" class="btn btn-primary">
          <input type="reset" value="Limpar" class="btn btn-warning">
       </div>
    </form>

    <?php
    if(isset($_POST['cadastrar'])) {
      include 'modelo/gato.class.php';
      include 'dao/gatodao.class.php';
      include 'util/padronizacao.class.php';
      include 'util/validacao.class.php';

      $erros = [];
      if(!Validacao::validarNome($_POST['nomeGato']))
      {
        $erros[] = 'Campo Nome inválido';
      }

      if(count($erros) != 0)
      {
        $_SESSION['erros'] = serialize($erros);
        header("location:cadastrogato.php");
        die();
      }

      $erros = [];
      if(!Validacao::validarRacaCor($_POST['racaGato']))
      {
        $erros[] = 'Campo Raça inválido';
      }

      if(count($erros) != 0)
      {
        $_SESSION['erros'] = serialize($erros);
        header("location:cadastrogato.php");
        die();
      }

      $erros = [];
      if(!Validacao::validarRacaCor($_POST['corGato']))
      {
        $erros[] = 'Campo Cor inválido!';
      }

      if(count($erros) != 0)
      {
        $_SESSION['erros'] = serialize($erros);
        header("location:cadastrogato.php");
        die();
      }

      $erros = [];
      if(!Validacao::validarIdade($_POST['idadeGato']))
      {
        $erros[] = 'Campo Idade inválido!';
      }

      if(count($erros) != 0)
      {
        $_SESSION['erros'] = serialize($erros);
        header("location:cadastrogato.php");
        die();
      }

      $erros = [];
      if(!Validacao::validarPeso($_POST['pesoGato']))
      {
        $erros[] = 'Campo Peso inválido!';
      }

      if(count($erros) != 0)
      {
        $_SESSION['erros'] = serialize($erros);
        header("location:cadastrogato.php");
        die();
      }


      $gato = new Gato();
      $gato->nomeGato = Padronizacao::padronizarNome($_POST['nomeGato']);
      $gato->racaGato = Padronizacao::padronizarNome($_POST['racaGato']);
      $gato->sexoGato = $_POST['sexoGato'];
      $gato->corGato = Padronizacao::padronizarNome($_POST['corGato']);
      $gato->idadeGato = $_POST['idadeGato'];
      $gato->pesoGato = $_POST['pesoGato'];
      $gato->castradoGato = $_POST['castradoGato'];

      $gatoDAO = new GatoDAO();
      $gatoDAO->cadastrarGato($gato);
      echo $gato;

      header("location:consultagato.php");
      }
       ?>






  </body>
</html>
