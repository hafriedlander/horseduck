<?php

// If there are too many ducks, we don't count them individually
const TOO_MANY_DUCKS = 20;

if (isset($argv[1]) && preg_match('/-*help$/', $argv[1])) {
  echo "Horse/duck\n";
  echo "\n";
  echo "With two arguments, first argument is path to input subleq 'sq' file, second is path to output horse/duck\n";
  echo "With one arguments, argument is path to input subleq 'sq' file, horse/duck goes to stdout\n";
  echo "With no arguments, subleq 'sq' comes from stdin, horse/duck goes to stdout\n";
  echo "\n";
  echo "(C) 2015 Hamish Friedlander. He is sorry for what he has done\n";
  die;
}

$inhandle = fopen(isset($argv[1]) ? $argv[1] : 'php://stdin', 'r');
if (!$inhandle) user_error("Can't count your ducks before they're hatched", E_USER_ERROR);

$outhandle = fopen(isset($argv[2]) ? $argv[2] : 'php://stdout', 'w');
if (!$outhandle) user_error("Can't open pond to fill with ducks", E_USER_ERROR);

while($in = fgets($inhandle)) {
  $out = array();
  $tokens = preg_split('/\s+/', trim($in));

  foreach($tokens as $token) {
    if (!is_numeric($token)) user_error("I don't know how many ducks $token is", E_USER_ERROR);

    if ($token == 0) {
      $out[] = '';
    }
    elseif ($token < 0 or $token > TOO_MANY_DUCKS) {
      $out[] = $token . ' ducks ';
    }
    else {
      $out[] = str_repeat('duck ', $token);
    }
  }

  fputs($outhandle, trim(implode('horse ', $out)) . "\n");
}

fclose($inhandle);
fclose($outhandle);
