<!DOCTYPE html>
<html lang="pt-br" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="vendor/components/jquery/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.3/js/tether.min.js"></script>
    <script src="vendor/twbs/bootstrap/dist/js/bootstrap.min.js"></script>
    <title>Alterar Cao</title>
  </head>
  <body>

    <h1 class="jumbotron bg-info">Cadastro Cão</h1>

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
          include 'dao/caodao.class.php';
          include 'modelo/cao.class.php';

          $caoDAO = new CaoDAO();
          $array = $caoDAO->filtrarCao($_GET['id'], "codigoCao");
          $cao = $array[0];

        }
        ?>

        <form name="cad" method="post" action="alterarcao.php">
          <div class="form-group">
           <input type="text" name="codigoCao" placeholder="Digite o codigo do cão" autofocus class="form-control" value="<?php if(isset($cao)) echo $cao->codigoCao; ?>">
          </div>
         <div class="form-group">
          <input type="text" name="nomeCao" placeholder="Digite o nome do cão" autofocus class="form-control" value="<?php if(isset($cao)) echo $cao->nomeCao; ?>">
         </div>
         <div class="form-group">
          <input type="text" name="racaCao" placeholder="Digite a raça do cão" class="form-control" value="<?php if(isset($cao)) echo $cao->racaCao; ?>">
         </div>
         <div class="form-group">
           <label>Selecione o sexo do cão</label>
           <select name="sexoCao" class="form-control">
             <option value="Macho">Macho</option>
             <?php if(isset($cao)) if($cao->sexoCao=='Macho')
             echo 'selected=selected'; ?>
             <option value="Femia" <?php if(isset($cao))  if($cao->sexoCao=='Femia') echo 'selected=selected'; ?>>Fêmia</option>
           </select>
         </div>
         <div class="form-group">
          <input type="text" name="corCao" placeholder="Digite a cor do cão" class="form-control" value="<?php if(isset($cao)) echo $cao->corCao; ?>">
         </div>
         <div class="form-group">
          <input type="number" name="idadeCao" placeholder="Digite a idade do cão" class="form-control" value="<?php if(isset($cao)) echo $cao->idadeCao; ?>">
         </div>
         <div class="form-group">
          <input type="number" name="pesoCao" placeholder="Digite o peso do cão" class="form-control" value="<?php if(isset($cao)) echo $cao->pesoCao; ?>">
         </div>
         <div class="form-group">
           <input type="submit" name="alterar" value="Alterar" class="btn btn-primary">
           <input type="reset" value="Limpar" class="btn btn-warning">
        </div>
     </form>

     <?php
     if(isset($_POST['alterar'])) {
       include 'modelo/cao.class.php';
       include 'dao/caodao.class.php';
       include 'util/padronizacao.class.php';

       $cao = new Cao();
       $cao->nomeCao = Padronizacao::padronizarNome($_POST['nomeCao']);
       $cao->racaCao = Padronizacao::padronizarNome($_POST['racaCao']);
       $cao->sexoCao = $_POST['sexoCao'];
       $cao->corCao = Padronizacao::padronizarNome($_POST['corCao']);
       $cao->idadeCao = $_POST['idadeCao'];
       $cao->pesoCao = $_POST['pesoCao'];
       $cao->codigoCao = $_POST['codigoCao'];

       $caoDAO = new CaoDAO();
       $caoDAO->alterarCao($cao);
       header("location:consultacao.php");
       unset($_POST['alterar']);
       unset($_GET['id']);
       unset($cao);
     }
     ?>

  </body>
</html>
