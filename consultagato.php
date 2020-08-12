<?php  ob_start(); ?>
<!DOCTYPE html>
<html lang="pt-br" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="vendor/components/jquery/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.3/js/tether.min.js"></script>
    <script src="vendor/twbs/bootstrap/dist/js/bootstrap.min.js"></script>
    <title>Consulta</title>
  </head>
  <body>

    <h1 class="jumbotron bg-info">Consulta de Gatos</h1>

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
            <a class="nav-link" href="consultagato.php">Consulta Gatos<span class="sr-only">(current)</span></a>
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

    <?php
    include 'dao/gatodao.class.php';
    include 'modelo/gato.class.php';
    $gatoDAO = new GatoDAO();
    $gatos = $gatoDAO->buscarGatos();

    if(count($gatos) == 0) {
      echo "<h1>Não há gatos cadastrados</h1>";
      return;
    }
   ?>


   <form name="filtrar" method="post" action="consultagato.php">
         <div class="row">
           <div class="form-group col-md-6">
             <input type="text" name="txtfiltro"
                    placeholder="Digite a sua pesquisa" class="form-control">
           </div>

           <div class="form-group col-md-6">
             <select name="selfiltro" class="form-control">
               <option value="todos">Todos</option>
               <option value="codigoGato">Código</option>
               <option value="nomeGato">Nome</option>
               <option value="racaGato">Raça</option>
               <option value="sexoGato">Sexo</option>
               <option value="corGato">Cor da pelagem</option>
               <option value="idadeGato">Idade</option>
               <option value="pesoGato">Peso</option>
               <option value="castradoGato">Castrado</option>
             </select>
           </div>
         </div>

         <div class="form-group">
           <input type="submit" name="filtrar" value="Filtrar" class="btn btn-primary btn-block">
         </div>
       </form>
<?php
   if(isset($_POST['filtrar'])){
     $pesquisa = $_POST['txtfiltro'];
     $filtro = $_POST['selfiltro'];

     if(!empty($pesquisa)){
       $catDAO = new GatoDAO();
       $gatos = $catDAO->filtrarGatos($pesquisa,$filtro);

       if(count($gatos) == 0){
         echo "<h3>Sua pesquisa não retornou nenhum Gato!</h3>";
         return;
       }

     }
   }
   ?>

   <?php
   echo "<div class='table-responsive'>";
     echo "<table class='table table-striped table-bordered table-hover table-condensed'>";
     echo "<thead>";
       echo "<tr>";
         echo "<th>Código do gato</th>";
         echo "<th>Nome do gato</th>";
         echo "<th>Raça do gato</th>";
         echo "<th>Sexo do gato</th>";
         echo "<th>Cor do gato</th>";
         echo "<th>Idade do gato</th>";
         echo "<th>Peso do gato</th>";
         echo "<th>Gato castrado?</th>";
         echo "<th>Alterar</th>";
         echo "<th>Excluir</th>";
       echo "</tr>";
     echo "</thead>";

     echo "<tfoot>";
     echo "<tr>";
       echo "<th>Código do gato</th>";
       echo "<th>Nome do gato</th>";
       echo "<th>Raça do gato</th>";
       echo "<th>Sexo do gato</th>";
       echo "<th>Cor do gato</th>";
       echo "<th>Idade do gato</th>";
       echo "<th>Peso do gato</th>";
       echo "<th>Gato castrado?</th>";
       echo "<th>Alterar</th>";
       echo "<th>Excluir</th>";
     echo "</tr>";
     echo "</tfoot>";
     echo "<tbody>";
     foreach($gatos as $gato) {
       echo "<tr>";
         echo "<td>$gato->codigoGato</td>";
         echo "<td>$gato->nomeGato</td>";
         echo "<td>$gato->racaGato</td>";
         echo "<td>$gato->sexoGato</td>";
         echo "<td>$gato->corGato</td>";
         echo "<td>$gato->idadeGato</td>";
         echo "<td>$gato->pesoGato</td>";
         echo "<td>$gato->castradoGato</td>";
         echo "<td><a class='btn btn-warning' href='alterargato.php?id={$gato->codigoGato}'>Alterar</a></td>";
         echo "<td><a class='btn btn-danger' href='consultagato.php?id={$gato->codigoGato}'>Excluir</a></td>";
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
  $gatoDAO->deletarGato($_GET['id']);
  header("location:consultagato.php");
  unset($_GET['id']);
}
?>
