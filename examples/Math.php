<?php

use DWZI\Library;

require __DIR__ . '/../src/Math.class.php';

$Math = new DWZI\Library\Math();
$Math
  ->setPreDecimals(0)
  ->setDecimals(3)
  ->setFillPreDecimals('*')
  ->setComma('.')
  ->setSeperator(',');

echo '<pre>';

echo '17498.124 = ' . $Math->format(17498.124, 10, 5, '-', ',', ' ') . PHP_EOL;
echo '1 + 2 = ' . $Math->add(1, 2) . PHP_EOL;
echo '2 - 1 = ' . $Math->sub(2, 1) . PHP_EOL;
echo '2 * 2 = ' . $Math->mul(2, 2) . PHP_EOL;
echo '4 / 2 = ' . $Math->div(4, 2) . PHP_EOL;
echo '4 % 3 = ' . $Math->mod(4, 3) . PHP_EOL;
echo '2 ^ 6 = ' . $Math->exp(2, 6) . PHP_EOL;
echo 'log2 (64) = ' . $Math->log(64, 2) . PHP_EOL;

$Math
  ->setDecimals(2)
  ->setPreDecimals(3);

echo '3√ 8 = ' . $Math->root(8, 3) . PHP_EOL;
echo '√ 16 = ' . $Math->sqrt(16) . PHP_EOL;
echo '2 > 3 = ' . ($Math->cmp(2, 3) == $Math::CMP_RIGHT_GREATER ? 'yes' : 'no') . PHP_EOL;
echo '2 = 2 = ' . ($Math->cmp(2, 2) == $Math::CMP_EQUAL ? 'yes' : 'no') . PHP_EOL;
echo '3 > 2 = ' . ($Math->cmp(3, 2) == $Math::CMP_LEFT_GREATER ? 'yes' : 'no') . PHP_EOL;
echo 'abs -4 = ' . $Math->abs(-4) . PHP_EOL;

echo '</pre>';

?>
