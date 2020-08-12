<?php
  require "conexaobanco.class.php";
  class CaoDAO
  {

    private $conexao = null;

    public function __construct()
    {
     $this->conexao = ConexaoBanco::getInstance();
    }

    public function __destruct()
    {

    }

    public function cadastrarCao($cao)
    {
      try {
        $statement = $this->conexao->prepare("INSERT into cao(codigoCao,nomeCao,racaCao,sexoCao,corCao,idadeCao,pesoCao) values(null,?,?,?,?,?,?)");
        $statement->bindValue(1, $cao->nomeCao);
        $statement->bindValue(2, $cao->racaCao);
        $statement->bindValue(3, $cao->sexoCao);
        $statement->bindValue(4, $cao->corCao);
        $statement->bindValue(5, $cao->idadeCao);
        $statement->bindValue(6, $cao->pesoCao);
        $statement->execute();
      } catch(PDOException $error) {
        echo "Erro ao cadastrar Cão! ".$error;
      }
    }

    public function buscarCao()
    {
      try {
        $statement = $this->conexao->query("select * from cao");
        $array = $statement->fetchAll(PDO::FETCH_CLASS, 'Cao');
        return $array;
      } catch(PDOException $error) {
        echo "Erro ao buscar Cão! ".$error;
      }
    }

    public function filtrarCao($pesquisa, $filtro)
    {
      try {
         $query = "";
         switch($filtro) {
           case "codigoCao": $query = "where codigoCao = ".$pesquisa;
           break;
           case "nomeCao": $query = "where nomeCao like '%".$pesquisa."%'";
           break;
           case "racaCao": $query = "where racaCao like '%".$pesquisa."%'";
           break;
           case "sexoCao": $query = "where sexoCao like '%".$pesquisa."%'";
           break;
           case "corCao": $query = "where corCao like '%".$pesquisa."%'";
           break;
           case "idadeCao": $query = "where idadeCao like '%".$pesquisa."%'";
           break;
           case "pesoCao": $query = "where pesoCao like '%".$pesquisa."%'";
           break;
           default: $query = "";
           break;
          }
          if(empty($pesquisa)) {
            $query = "";
          }
          $statement = $this->conexao->query("select * from cao {$query}");
          $array = $statement->fetchAll(PDO::FETCH_CLASS, 'Cao');
          return $array;
      } catch(PDOException $error) {
        echo "Erro ao filtrar! ".$error;
      }
      }

      public function deletarCao($id)
      {
        try {
          $statement = $this->conexao->prepare("delete from cao where codigoCao = ?");
          $statement->bindValue(1, $id);
          $statement->execute();
        } catch(PDOException $error) {
          echo "Erro ao deletar! ".$error;
        }
      }

      public function alterarCao($cao)
      {
        try {
          $statement = $this->conexao->prepare("update cao set nomeCao=?, racaCao=?, sexoCao=?, corCao=?, idadeCao=?, pesoCao=? where codigoCao=?");
          $statement->bindValue(1, $cao->nomeCao);
          $statement->bindValue(2, $cao->racaCao);
          $statement->bindValue(3, $cao->sexoCao);
          $statement->bindValue(4, $cao->corCao);
          $statement->bindValue(5, $cao->idadeCao);
          $statement->bindValue(6, $cao->pesoCao);
          $statement->bindValue(7, $cao->codigoCao);
          $statement->execute();
        } catch(PDOException $error) {
          echo "Erro ao alterar Cão! ".$error;
        }
      }

  }
