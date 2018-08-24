<?php

namespace DWZI\Library;

class BCMath extends Math {

  /**
   * constructor
   *
   * @param none
   * @return none
   */
  function __construct() {

    bcscale(self::getDecimals());
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

    parent::setDecimals($Decimals);
    bcscale(self::getDecimals());

    return $this;
  }

  /**
   * format
   *
   * function for formatting a specific value with optional parameters
   *
   * @param int|string $value
   * @param int $PreDecimals (optional)
   * @param null|int $Decimals (optional)
   * @param null|string $FillPreDecimals (optional)
   * @param null|string $Comma (optional)
   * @param null|string $Seperator (optional)
   * @return string
   */
  public function format($value, $PreDecimals = null, $Decimals = null, $FillPreDecimals = null, $Comma = null, $Seperator = null) {

    $PreDecimals = $PreDecimals === null ? parent::getPreDecimals() : parent::checkPreDecimals($PreDecimals);
    $Decimals = $Decimals === null ? parent::getDecimals() : parent::checkDecimals($Decimals);
    $FillPreDecimals = $FillPreDecimals === null ? parent::getFillPreDecimals() : $FillPreDecimals;
    $Comma = $Comma === null ? parent::getComma() : $Comma;
    $Seperator = $Seperator === null ? parent::getSeperator() : $Seperator;

    $parts = explode($Comma, (string)$value);
    $preDec = (string)$parts[0];
    $postDec = empty($parts[1]) ? '' : (string)$parts[1];

    $sign = '';
    if (in_array($preDec[0], array('-', '+'))) {

      $sign = $preDec[0];
      $preDec = substr($preDec, 1);
    }

    $preDec = implode($Seperator, array_reverse(array_map(function ($elem) { return strrev($elem); }, str_split(strrev($preDec) , 3))));
    $preDec = str_pad($preDec, $PreDecimals + substr_count($preDec, $Seperator), $FillPreDecimals, STR_PAD_LEFT);

    $postDec = str_pad($postDec, $Decimals, '0', STR_PAD_RIGHT);

    $str = $sign . $preDec . $Comma . $postDec;

    return $str;
  }

  /**
   * add
   *
   * function for adding two values
   *
   * @param string $summand1
   * @param string $summand2
   * @return string
   */
  public function add($summand1, $summand2) {

    return self::format(bcadd((string)$summand1, (string)$summand2));
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

    return self::format(bcsub((string)$minuend, (string)$subtrahend));
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

    return self::format(bcmul((string)$multiplier, (string)$multiplicant));
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

    return self::format(bcdiv((string)$dividend, (string)$divisor));
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

    return self::format(bcmod((string)$dividend, (string)$divisor));
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

    return self::format(bcpow((string)$base, (string)$exponent));
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
/* missing
  public function root($radicand, $degree) {

    return self::format(bcpow((string)$radicand, 1 / $degree));
  }
*/
  /**
   * sqrt
   *
   * function for square root func
   *
   * @param int $radicand
   * @return string
   */
  public function sqrt($radicand) {

    return self::format(bcsqrt((string)$radicand));
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
/* missing
  public function log($antilogarithm, $base) {

    return self::format(log($antilogarithm, $base));
  }
*/
  /**
   * abs
   *
   * function for absolute value
   *
   * @param int $value
   * @return string
   */
  public function abs($value) {

    $value = (string)$value;

    if (in_array($value[0], array('-', '+'))) {

      $value = substr($value, 1);
    }

    return self::format($value);
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

    switch (bccomp((string)$left, (string)$right)) {
      case 0: return self::CMP_EQUAL;
      case 1: return self::CMP_LEFT_GREATER;
      case -1: return self::CMP_RIGHT_GREATER;
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

    $value = (string)$value;
    if (in_array( self::cmp( bcmul( bcsub($value, bcadd($value, '0', $Decimals), 1), 10, 0 ), '5'), array(self::CMP_EQUAL, self::CMP_LEFT_GREATER) ) ) {

      return self::format(bcadd($value, '1', $Decimals));

    } else {

      return self::format(bcadd($value, '0', $Decimals));
    }
  }

  /**
   * ceil
   *
   * function for ceiling values
   *
   * @param int|string $value
   * @return string
   */
  protected function ceil($value) {

    $value = bcadd( (string)$value, 0, 1);
    if ($value[strlen($value)-1] == '0') {

      return $value;

    } else {

      return bcadd($value, '1', 0);
    }
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

      return self::format( self::ceil( (string)$value ) );
    }

    if ($Decimals < 0) {

      $Decimals = (string)$Decimals;
      if (in_array($Decimals[0], array('-', '+'))) {

        $Decimals = substr($Decimals, 1);
      }

      $factor = bcpow('10', (string)$Decimals, 0);

      return self::format( bcmul( self::ceil( bcdiv( (string)$value, $factor ) ), $factor ) );

    } else {

      $factor = bcpow('10', (string)$Decimals, 0);

      return self::format( bcdiv( self::ceil( bcmul( (string)$value, $factor ) ), $factor ) );
    }
  }

  /**
   * floor
   *
   * function for flooring values
   *
   * @param int|string $value
   * @return string
   */
  protected function floor($value) {

    return bcadd( (string)$value, '0', 0);
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

      return self::format( self::floor( (string)$value ) );
    }

    if ($Decimals < 0) {

      $Decimals = (string)$Decimals;
      if (in_array($Decimals[0], array('-', '+'))) {

        $Decimals = substr($Decimals, 1);
      }

      $factor = bcpow('10', (string)$Decimals, 0);

      return self::format( bcmul( self::floor( bcdiv( (string)$value, $factor ) ), $factor ) );

    } else {

      $factor = bcpow('10', (string)$Decimals, 0);

      return self::format( bcdiv( self::floor( bcmul( (string)$value, $factor ) ), $factor ) );
    }
  }

}
