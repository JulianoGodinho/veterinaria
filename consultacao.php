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

    <h1 class="jumbotron bg-info">Consulta de Cão</h1>

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
    include 'dao/caodao.class.php';
    include 'modelo/cao.class.php';
    $caoDAO = new CaoDAO();
    $caos = $caoDAO->buscarCao();

    if(count($caos) == 0) {
      echo "<h1>Não há cães cadastrados</h1>";
      return;
    }
   ?>


   <form name="filtrar" method="post" action="consultacao.php">
         <div class="row">
           <div class="form-group col-md-6">
             <input type="text" name="txtfiltro"
                    placeholder="Digite a sua pesquisa" class="form-control">
           </div>

           <div class="form-group col-md-6">
             <select name="selfiltro" class="form-control">
               <option value="todos">Todos</option>
               <option value="codigoCao">Código</option>
               <option value="nomeCao">Nome</option>
               <option value="racaCao">Raça</option>
               <option value="sexoCao">Sexo</option>
               <option value="corCao">Cor da pelagem</option>
               <option value="idadeCao">Idade</option>
               <option value="pesoCao">Peso</option>
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
       $dogDAO = new CaoDAO();
       $caos = $dogDAO->filtrarCao($pesquisa,$filtro);

       if(count($caos) == 0){
         echo "<h3>Sua pesquisa não retornou nenhum Cão!</h3>";
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
         echo "<th>Código do cão</th>";
         echo "<th>Nome do cão</th>";
         echo "<th>Raça do cão</th>";
         echo "<th>Sexo do cão</th>";
         echo "<th>Cor do cão</th>";
         echo "<th>Idade do cão</th>";
         echo "<th>Peso do cão</th>";
         echo "<th>Alterar</th>";
         echo "<th>Excluir</th>";
       echo "</tr>";
     echo "</thead>";

     echo "<tfoot>";
     echo "<tr>";
       echo "<th>Código do cão</th>";
       echo "<th>Nome do cão</th>";
       echo "<th>Raça do cão</th>";
       echo "<th>Sexo do cão</th>";
       echo "<th>Cor do cão</th>";
       echo "<th>Idade do cão</th>";
       echo "<th>Peso do cão</th>";
       echo "<th>Alterar</th>";
       echo "<th>Excluir</th>";
     echo "</tr>";
     echo "</tfoot>";
     echo "<tbody>";
     foreach($caos as $cao) {
       echo "<tr>";
         echo "<td>$cao->codigoCao</td>";
         echo "<td>$cao->nomeCao</td>";
         echo "<td>$cao->racaCao</td>";
         echo "<td>$cao->sexoCao</td>";
         echo "<td>$cao->corCao</td>";
         echo "<td>$cao->idadeCao</td>";
         echo "<td>$cao->pesoCao</td>";
         echo "<td><a class='btn btn-warning' href='alterarcao.php?id={$cao->codigoCao}'>Alterar</a></td>";
         echo "<td><a class='btn btn-danger' href='consultacao.php?id={$cao->codigoCao}'>Excluir</a></td>";
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
  $caoDAO->deletarCao($_GET['id']);
  header("location:consultacao.php");
  unset($_GET['id']);
}
?>
