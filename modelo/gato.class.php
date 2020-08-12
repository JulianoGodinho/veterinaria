<?php
  class Gato
  {
    //atributos
    private $codigoGato;
    private $nomeGato;
    private $racaGato;
    private $sexoGato;
    private $corGato;
    private $idadeGato;
    private $pesoGato;
    private $castradoGato;

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
      return nl2br("Codigo do gato: $this->codigoGato
                   Nome do gato: $this->nomeGato
                   Raça do gato: $this->racaGato
                   Sexo do gato: $this->sexoGato
                   Cor do gato: $this->corGato
                   Idade do gato: $this->idadeGato
                   Peso do gato: $this->pesoGato
                   Castrado: $this->castradoGato");
    }
  }
