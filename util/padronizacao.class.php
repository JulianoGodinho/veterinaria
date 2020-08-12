<?php
  class Padronizacao
  {

    public static function padronizarNome($valor): string
    {
      return ucwords(strtolower($valor));
    }

  }
