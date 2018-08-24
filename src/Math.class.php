<?php

namespace DWZI\Library;

class Math {

  const CMP_EQUAL = 0;
  const CMP_LEFT_GREATER = 1;
  const CMP_RIGHT_GREATER = -1;


  private $PreDecimals = 0;
  private $Decimals = 2;
  private $FillPreDecimals = ' ';

  private $Comma = '.';
  private $Seperator = ',';

  /**
   * constructor
   *
   * @param none
   * @return none
   */
  function __construct() {
  }

  /**
   * destructor
   *
   * @param none
   * @return none
   */
  function __destruct() {
  }

  /**
   * get PreDecimals
   *
   * function for getting the private var PreDecimals
   *
   * @param none
   * @return int
   */
  public function getPreDecimals() {

    return $this->PreDecimals;
  }

  /**
   * check PreDecimals
   *
   * function for checking the value of the private var PreDecimals
   *
   * @param int $PreDecimals
   * @return int
   */
  private function checkPreDecimals(int $PreDecimals) {

    if (!(
      is_numeric($PreDecimals)
    )) {
      throw new \InvalidArgumentException('PreDecimals has to be an integer');
    }

    return $PreDecimals;
  }

  /**
   * set PreDecimals
   *
   * function for setting the value of the private var PreDecimals
   *
   * @param int $PreDecimals
   * @return class
   */
  public function setPreDecimals($PreDecimals) {

    $this->PreDecimals = self::checkPreDecimals($PreDecimals);

    return $this;
  }

  /**
   * get Decimals
   *
   * function for getting the private var Decimals
   *
   * @param none
   * @return return int
   */
  public function getDecimals() {

    return $this->Decimals;
  }

  /**
   * check Decimals
   *
   * function for checking the value of the private var Decimals
   *
   * @param int $Decimals
   * @return int
   */
  private function checkDecimals($Decimals) {

    if (!(
      is_numeric($Decimals)
    )) {
      throw new \InvalidArgumentException('Decimals has to be an integer');
    }

    return $Decimals;
  }

  /**
   * set Decimals
   *
   * function for setting the value of the private var Decimals
   *
   * @param int $Decimals
   * @return class
   */
  public function setDecimals($Decimals) {

    $this->Decimals = self::checkDecimals($Decimals);

    return $this;
  }

  /**
   * get FillPreDecimals
   *
   * function for getting the private var FillPreDecimals
   *
   * @param none
   * @return string
   */
  public function getFillPreDecimals() {

    return $this->FillPreDecimals;
  }

  /**
   * set FillPreDecimals
   *
   * function for setting the value of the private var FillPreDecimals
   *
   * @param int $FillPreDecimals
   * @return class
   */
  public function setFillPreDecimals($FillPreDecimals) {

    $this->FillPreDecimals = $FillPreDecimals;

    return $this;
  }

  /**
   * get Comma
   *
   * function for getting the private var Comma
   *
   * @param none
   * @return string
   */
  public function getComma() {

    return $this->Comma;
  }

  /**
   * set Comma
   *
   * function for setting the value of the private var Comma
   *
   * @param int $Comma
   * @return class
   */
  public function setComma($Comma) {

    $this->Comma = $Comma;

    return $this;
  }

  /**
   * get Seperator
   *
   * function for getting the private var Seperator
   *
   * @param none
   * @return string
   */
  public function getSeperator() {

    return $this->Seperator;
  }

  /**
   * set Seperator
   *
   * function for setting the value of the private var Seperator
   *
   * @param int $Seperator
   * @return class
   */
  public function setSeperator($Seperator) {

    $this->Seperator = $Seperator;

    return $this;
  }

  /**
   * format
   *
   * function for formatting a specific value with optional parameters
   *
   * @param int $value
   * @param int $PreDecimals (optional)
   * @param null|int $Decimals (optional)
   * @param null|string $FillPreDecimals (optional)
   * @param null|string $Comma (optional)
   * @param null|string $Seperator (optional)
   * @return string
   */
  public function format($value, $PreDecimals = null, $Decimals = null, $FillPreDecimals = null, $Comma = null, $Seperator = null) {

    $PreDecimals = $PreDecimals === null ? self::getPreDecimals() : self::checkPreDecimals($PreDecimals);
    $Decimals = $Decimals === null ? self::getDecimals() : self::checkDecimals($Decimals);
    $FillPreDecimals = $FillPreDecimals === null ? self::getFillPreDecimals() : $FillPreDecimals;
    $Comma = $Comma === null ? self::getComma() : $Comma;
    $Seperator = $Seperator === null ? self::getSeperator() : $Seperator;

    $str = number_format($value, $Decimals, $Comma, $Seperator);
    $str = str_pad($str, $PreDecimals + substr_count($str, $Seperator) + substr_count($str, $Comma) + $Decimals, $FillPreDecimals, STR_PAD_LEFT);

    return $str;
  }

  /**
   * add
   *
   * function for adding two values
   *
   * @param int $summand1
   * @param int $summand2
   * @return string
   */
  public function add($summand1, $summand2) {

    return self::format($summand1 + $summand2);
  }

  /**
   * sub
   *
   * function for substracting two values
   *
   * @param int $minuend
   * @param int $subtrahend
   * @return string
   */
  public function sub($minuend, $subtrahend) {

    return self::format($minuend - $subtrahend);
  }

  /**
   * mul
   *
   * function for multipling two values
   *
   * @param int $multiplier
   * @param int $multiplicant
   * @return string
   */
  public function mul($multiplier, $multiplicant) {

    return self::format($multiplier * $multiplicant);
  }

  /**
   * div
   *
   * function for dividing two values
   *
   * @param int $dividend
   * @param int $divisor
   * @return string
   */
  public function div($dividend, $divisor) {

    return self::format($dividend / $divisor);
  }

  /**
   * mod
   *
   * function for finding the modulo
   *
   * @param int $dividend
   * @param int $divisor
   * @return string
   */
  public function mod($dividend, $divisor) {

    return self::format($dividend % $divisor);
  }

  /**
   * exp
   *
   * function for exponential func
   *
   * @param int $base
   * @param int $exponent
   * @return string
   */
  public function exp($base, $exponent) {

    return self::format(pow($base, $exponent));
  }

  /**
   * root
   *
   * function for root func
   *
   * @param int $radicand
   * @param int $degree
   * @return string
   */
  public function root($radicand, $degree) {

    return self::format(pow($radicand, 1 / $degree));
  }

  /**
   * sqrt
   *
   * function for square root func
   *
   * @param int $radicand
   * @return string
   */
  public function sqrt($radicand) {

    return self::format(pow($radicand, 1 / 2));
  }

  /**
   * log
   *
   * function for logarithm func
   *
   * @param int $antilogarithm
   * @param int $base
   * @return string
   */
  public function log($antilogarithm, $base) {

    return self::format(log($antilogarithm, $base));
  }

  /**
   * abs
   *
   * function for absolute value
   *
   * @param int $value
   * @return string
   */
  public function abs($value) {

    return self::format(abs($value));
  }

  /**
   * cmp
   *
   * function for comparing two values
   *
   * @param int $left
   * @param int $right
   * @return int
   */
  public function cmp($left, $right) {

    if ($left === $right) {

      return self::CMP_EQUAL;

    } else if ($left > $right) {

      return self::CMP_LEFT_GREATER;

    } else {

      return self::CMP_RIGHT_GREATER;
    }
  }

  /**
   * round
   *
   * function for rounding values
   *
   * @param int $value
   * @param int $Decimals (optional)
   * @return string
   */
  public function round($value, $Decimals = null) {

    $Decimals = $Decimals === null ? self::getDecimals() : self::checkDecimals($Decimals);

    return self::format(round($value, $Decimals));
  }

  /**
   * up
   *
   * function for rounding up values
   *
   * @param int $value
   * @param int $Decimals (optional)
   * @return string
   */
  public function up($value, $Decimals = null) {

    $Decimals = $Decimals === null ? self::getDecimals() : self::checkDecimals($Decimals);

    if ($Decimals == 0) {

      return self::format(ceil($value));
    }

    $factor = pow(10, $Decimals);

    return self::format(ceil($value * $factor) / $factor);
  }

  /**
   * down
   *
   * function for rounding down values
   *
   * @param int $value
   * @param int $Decimals (optional)
   * @return string
   */
  public function down($value, $Decimals = null) {

    $Decimals = $Decimals === null ? self::getDecimals() : self::checkDecimals($Decimals);

    if ($Decimals == 0) {

      return self::format(floor($value));
    }

    $factor = pow(10, $Decimals);

    return self::format(floor($value * $factor) / $factor);
  }


}
