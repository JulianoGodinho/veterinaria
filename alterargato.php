<!DOCTYPE html>
<html lang="pt-br" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="vendor/components/jquery/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.3/js/tether.min.js"></script>
    <script src="vendor/twbs/bootstrap/dist/js/bootstrap.min.js"></script>
    <title>Alterar Gatos</title>
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

        <h2 class="jumbotron bg-info">Formulário</h2>

        <?php
        if(isset($_GET['id'])) {
          include 'dao/gatodao.class.php';
          include 'modelo/gato.class.php';

          $gatoDAO = new GatoDAO();
          $array = $gatoDAO->filtrarGatos($_GET['id'], "codigoGato");
          $gato = $array[0];

        }
        ?>

        <form name="cad" method="post" action="alterargato.php">
          <div class="form-group">
           <input type="text" name="codigoGato" placeholder="Digite o codigo do gato" autofocus class="form-control" value="<?php if(isset($gato)) echo $gato->codigoGato; ?>">
          </div>
         <div class="form-group">
          <input type="text" name="nomeGato" placeholder="Digite o nome do gato" autofocus class="form-control" value="<?php if(isset($gato)) echo $gato->nomeGato; ?>">
         </div>
         <div class="form-group">
          <input type="text" name="racaGato" placeholder="Digite a raça do gato" class="form-control" value="<?php if(isset($gato)) echo $gato->racaGato; ?>">
         </div>
         <div class="form-group">
           <label>Selecione o sexo do gato</label>
           <select name="sexoGato" class="form-control">
             <option value="Macho">Macho</option>
             <?php if(isset($gato)) if($gato->sexoGato=='Macho')
             echo 'selected=selected'; ?>
             <option value="Femia" <?php if(isset($gato))  if($gato->sexoGato=='Femia') echo 'selected=selected'; ?>>Fêmia</option>
           </select>
         </div>
         <div class="form-group">
          <input type="text" name="corGato" placeholder="Digite a cor do gato" class="form-control" value="<?php if(isset($gato)) echo $gato->corGato; ?>">
         </div>
         <div class="form-group">
          <input type="number" name="idadeGato" placeholder="Digite a idade do gato" class="form-control" value="<?php if(isset($gato)) echo $gato->idadeGato; ?>">
         </div>
         <div class="form-group">
          <input type="number" name="pesoGato" placeholder="Digite o peso do gato" class="form-control" value="<?php if(isset($gato)) echo $gato->pesoGato; ?>">
         </div>
         <div class="form-group">
         <p>O gato ja esta castrado? </p>
         <input type="radio" name="castradoGato" value="Sim" <?php if(isset($gato)) if($gato->castradoGato=='Sim') echo 'selected=selected';?> >
         <label>Sim</label>
         <input type="radio" name="castradoGato" value="Não" <?php if(isset($gato)) if($gato->castradoGato=='Não') echo 'selected=selected';?> >
         <label>Não</label>
         </div>
         <div class="form-group">
           <input type="submit" name="alterar" value="Alterar" class="btn btn-primary">
           <input type="reset" value="Limpar" class="btn btn-warning">
        </div>


     </form>

     <?php
     if(isset($_POST['alterar'])) {
       include 'modelo/gato.class.php';
       include 'dao/gatodao.class.php';
       include 'util/padronizacao.class.php';

       $gato = new Gato();
       $gato->nomeGato = Padronizacao::padronizarNome($_POST['nomeGato']);
       $gato->racaGato = Padronizacao::padronizarNome($_POST['racaGato']);
       $gato->sexoGato = $_POST['sexoGato'];
       $gato->corGato = Padronizacao::padronizarNome($_POST['corGato']);
       $gato->idadeGato = $_POST['idadeGato'];
       $gato->pesoGato = $_POST['pesoGato'];
       $gato->castradoGato = $_POST['castradoGato'];
       $gato->codigoGato = $_POST['codigoGato'];


       $gatoDAO = new GatoDAO();
       $gatoDAO->alterarGato($gato);
       header("location:consultagato.php");
       unset($_POST['alterar']);
       unset($_GET['id']);
       unset($gato);
     }
     ?>

  </body>
</html>
