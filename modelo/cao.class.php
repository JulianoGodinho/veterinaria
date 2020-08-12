<?php
  class Cao
  {
    //atributos
    private $codigoCao;
    private $nomeCao;
    private $racaCao;
    private $sexoCao;
    private $corCao;
    private $idadeCao;
    private $pesoCao;

    public function __construct() //construtores
    {

    }

    public function __destruct()
    {

    }

    public function __get($atributo) //get e set
    {
      return $this->$atributo;
    }

    public function __set($atributo, $valor)
    {
      $this->$atributo = $valor;
    }

    public function __toString()
    {
      return nl2br("Codigo do cão: $this->codigoCao
                   Nome do Cão: $this->nomeCao
                   Raça do Cão: $this->racaCao
                   Sexo do Cão: $this->sexoCao
                   Cor do Cão: $this->corCao
                   Idade do Cão: $this->idadeCao
                   Peso do cão: $this->pesoCao");
    }
  }
