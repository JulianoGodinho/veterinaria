<<?php
  class Validacao
  {

    public static function validarNome($valor): bool
    {
      $expressao = "/^[a-zA-ZÀ-ú ]{2,15}$/";
      return preg_match($expressao,$valor);
    }

    public static function validarRacaCor($valor): bool
    {
      $expressao = "/^[a-zA-ZÀ-ú ]{2,15}$/";
      return preg_match($expressao,$valor);
    }

    public static function validarIdade($valor): bool
    {
      $expressao = "/^[0-9]{1,2}$/";
      return preg_match($expressao,$valor);
    }

    public static function validarPeso($valor): bool
    {
      $expressao = "/^[0-9]{1,2}$/";
      return preg_match($expressao,$valor);
    }
  }
