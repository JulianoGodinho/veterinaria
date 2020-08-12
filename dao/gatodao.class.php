<?php
  require "conexaobanco.class.php";
  class GatoDAO
  {

    private $conexao = null;

    public function __construct()
    {
     $this->conexao = ConexaoBanco::getInstance();
    }

    public function __destruct()
    {

    }

    public function cadastrarGato($gato)
    {
      try {
        $statement = $this->conexao->prepare("INSERT into gato(codigoGato,nomeGato,racaGato,sexoGato,corGato,idadeGato,pesoGato,castradoGato) values(null,?,?,?,?,?,?,?)");
        $statement->bindValue(1, $gato->nomeGato);
        $statement->bindValue(2, $gato->racaGato);
        $statement->bindValue(3, $gato->sexoGato);
        $statement->bindValue(4, $gato->corGato);
        $statement->bindValue(5, $gato->idadeGato);
        $statement->bindValue(6, $gato->pesoGato);
        $statement->bindValue(7, $gato->castradoGato);
        $statement->execute();
      } catch(PDOException $error) {
        echo "Erro ao cadastrar gato! ".$error;
      }
    }

    public function buscarGatos()
    {
      try {
        $statement = $this->conexao->query("select * from gato");
        $array = $statement->fetchAll(PDO::FETCH_CLASS, 'Gato');
        return $array;
      } catch(PDOException $error) {
        echo "Erro ao buscar gato! ".$error;
      }
    }

    public function filtrarGatos($pesquisa, $filtro)
    {
      try {
         $query = "";
         switch($filtro) {
           case "codigoGato": $query = "where codigoGato = ".$pesquisa;
           break;
           case "nomeGato": $query = "where nomeGato like '%".$pesquisa."%'";
           break;
           case "racaGato": $query = "where racaGato like '%".$pesquisa."%'";
           break;
           case "sexoGato": $query = "where sexoGato like '%".$pesquisa."%'";
           break;
           case "corGato": $query = "where corGato like '%".$pesquisa."%'";
           break;
           case "idadeGato": $query = "where idadeGato like '%".$pesquisa."%'";
           break;
           case "pesoGato": $query = "where pesoGato like '%".$pesquisa."%'";
           break;
           case "castradoGato": $query = "where castradoGato like '%".$pesquisa."%'";
           break;
           default: $query = "";
           break;
          }
          if(empty($pesquisa)) {
            $query = "";
          }
          $statement = $this->conexao->query("select * from gato {$query}");
          $array = $statement->fetchAll(PDO::FETCH_CLASS, 'Gato');
          return $array;
      } catch(PDOException $error) {
        echo "Erro ao filtrar! ".$error;
      }
      }

      public function deletarGato($id)
      {
        try {
          $statement = $this->conexao->prepare("delete from gato where codigoGato = ?");
          $statement->bindValue(1, $id);
          $statement->execute();
        } catch(PDOException $error) {
          echo "Erro ao deletar! ".$error;
        }
      }

      public function alterarGato($gato)
      {
        try {
          $statement = $this->conexao->prepare("update gato set nomeGato=?, racaGato=?, sexoGato=?, corGato=?, idadeGato=?, pesoGato=?, castradoGato=? where codigoGato=?");
          $statement->bindValue(1, $gato->nomeGato);
          $statement->bindValue(2, $gato->racaGato);
          $statement->bindValue(3, $gato->sexoGato);
          $statement->bindValue(4, $gato->corGato);
          $statement->bindValue(5, $gato->idadeGato);
          $statement->bindValue(6, $gato->pesoGato);
          $statement->bindValue(7, $gato->castradoGato);
          $statement->bindValue(8, $gato->codigoGato);
          $statement->execute();
        } catch(PDOException $error) {
          echo "Erro ao alterar gato! ".$error;
        }
      }

  }
