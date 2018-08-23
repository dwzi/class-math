<?php

namespace DWZI\Library;

class Math {

  const CMP_EQUAL = 0;
  const CMP_LEFT_GREATER = 1;
  const CMP_RIGHT_GREATER = -1;


  var $predecimals = 0;
  var $fillpredecimals = ' ';
  var $decimals = 2;

  var $comma = '.';
  var $seperator = ',';


  function __construct($predecimals = null, $decimals = null, $fillpredecimals = null, $comma = null, $seperator = null) {

    self::checkParameters($predecimals, $decimals, $fillpredecimals, $comma, $seperator);

    self::setPreDecimals($predecimals);
    self::setDecimals($decimals);
    self::setFillPreDecimals($fillpredecimals);
    self::setComma($comma);
    self::setSeperator($seperator);
  }

  function __destruct() {
  }


  function getPreDecimals() {

    return $this->predecimals;
  }

  function setPreDecimals($predecimals) {

    $this->predecimals = $predecimals;
  }

  function getFillPreDecimals() {

    return $this->fillpredecimals;
  }

  function setFillPreDecimals($fillpredecimals) {

    $this->fillpredecimals = $fillpredecimals;
  }

  function getDecimals() {

    return $this->decimals;
  }

  function setDecimals($decimals) {

    $this->decimals = $decimals;
  }

  function getComma() {

    return $this->comma;
  }

  function setComma($comma) {

    $this->comma = $comma;
  }

  function getSeperator() {

    return $this->seperator;
  }

  function setSeperator($seperator) {

    $this->seperator = $seperator;
  }


  private function checkParameters(&$predecimals = null, &$decimals = null, &$fillpredecimals = null, &$comma = null, &$seperator = null) {

    if ($predecimals === null || !is_numeric($predecimals)) {

      $predecimals = self::getPreDecimals();
    }

    if ($decimals === null || !is_numeric($decimals)) {

      $decimals = self::getDecimals();
    }

    if ($fillpredecimals === null) {

      $fillpredecimals = self::getFillPreDecimals();
    }

    if ($comma === null) {

      $comma = self::getComma();
    }

    if ($seperator === null) {

      $seperator = self::getSeperator();
    }

    return null;
  }

  public function format($value, $predecimals = null, $decimals = null, $fillpredecimals = null, $comma = null, $seperator = null) {

    self::checkParameters($predecimals, $decimals, $fillpredecimals, $comma, $seperator);

    $str = number_format($value, $decimals, $comma, $seperator);
    $str = str_pad($str, $predecimals + substr_count($str, $seperator) + substr_count($str, $comma) + $decimals, $fillpredecimals, STR_PAD_LEFT);
    return $str;
  }


  public function add($summand1, $summand2, $predecimals = null, $decimals = null, $fillpredecimals = null, $comma = null, $seperator = null) {

    self::checkParameters($predecimals, $decimals, $fillpredecimals, $comma, $seperator);

    return self::format($summand1 + $summand2, $predecimals, $decimals, $fillpredecimals, $comma, $seperator);
  }

  public function sub($minuend, $subtrahend, $predecimals = null, $decimals = null, $fillpredecimals = null, $comma = null, $seperator = null) {

    self::checkParameters($predecimals, $decimals, $fillpredecimals, $comma, $seperator);

    return self::format($minuend - $subtrahend, $predecimals, $decimals, $fillpredecimals, $comma, $seperator);
  }

  public function mul($multiplier, $multiplicant, $predecimals = null, $decimals = null, $fillpredecimals = null, $comma = null, $seperator = null) {

    self::checkParameters($predecimals, $decimals, $fillpredecimals, $comma, $seperator);

    return self::format($multiplier * $multiplicant, $predecimals, $decimals, $fillpredecimals, $comma, $seperator);
  }

  public function div($dividend, $divisor, $predecimals = null, $decimals = null, $fillpredecimals = null, $comma = null, $seperator = null) {

    self::checkParameters($predecimals, $decimals, $fillpredecimals, $comma, $seperator);

    return self::format($dividend / $divisor, $predecimals, $decimals, $fillpredecimals, $comma, $seperator);
  }

  public function mod($dividend, $divisor, $predecimals = null, $decimals = null, $fillpredecimals = null, $comma = null, $seperator = null) {

    self::checkParameters($predecimals, $decimals, $fillpredecimals, $comma, $seperator);

    return self::format($dividend % $divisor, $predecimals, $decimals, $fillpredecimals, $comma, $seperator);
  }

  public function exp($base, $exponent, $predecimals = null, $decimals = null, $fillpredecimals = null, $comma = null, $seperator = null) {

    self::checkParameters($predecimals, $decimals, $fillpredecimals, $comma, $seperator);

    return self::format(pow($base, $exponent), $predecimals, $decimals, $fillpredecimals, $comma, $seperator);
  }

  public function root($radicand, $degree, $predecimals = null, $decimals = null, $fillpredecimals = null, $comma = null, $seperator = null) {

    self::checkParameters($predecimals, $decimals, $fillpredecimals, $comma, $seperator);

    return self::format(pow($radicand, 1 / $degree), $predecimals, $decimals, $fillpredecimals, $comma, $seperator);
  }

  public function sqrt($radicand, $predecimals = null, $decimals = null, $fillpredecimals = null, $comma = null, $seperator = null) {

    self::checkParameters($predecimals, $decimals, $fillpredecimals, $comma, $seperator);

    return self::format(pow($radicand, 1 / 2), $predecimals, $decimals, $fillpredecimals, $comma, $seperator);
  }

  public function log($antilogarithm, $base, $predecimals = null, $decimals = null, $fillpredecimals = null, $comma = null, $seperator = null) {

    self::checkParameters($predecimals, $decimals, $fillpredecimals, $comma, $seperator);

    return self::format(log($antilogarithm, $base), $predecimals, $decimals, $fillpredecimals, $comma, $seperator);
  }

  public function abs($value, $predecimals = null, $decimals = null, $fillpredecimals = null, $comma = null, $seperator = null) {

    self::checkParameters($predecimals, $decimals, $fillpredecimals, $comma, $seperator);

    return self::format(abs($value), $predecimals, $decimals, $fillpredecimals, $comma, $seperator);
  }


  public function cmp($left, $right) {

    if ($left === $right) {

      return self::CMP_EQUAL;

    } else if ($left > $right) {

      return self::CMP_LEFT_GREATER;

    } else {

      return self::CMP_RIGHT_GREATER;
    }
  }

}
