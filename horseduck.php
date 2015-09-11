<?php

if (isset($argv[1]) && preg_match('/-*help$/', $argv[1])) {
	echo "Horse/duck\n";
	echo "\n";
	echo "With one argument, argument is path to horse/duck\n";
	echo "With no arguments, horse/duck comes from stdin\n";
	echo "\n";
	echo "(C) 2015 Hamish Friedlander. He is sorry for what he has done\n";
	die;
}

// First, parse horse / duck into a "memory" array

$memory = array();
$horse = 0;
$duck = 0;

$handle = fopen(isset($argv[1]) ? $argv[1] : 'php://stdin', 'r');
if (!$handle) user_error("Where are the ducks? Where are the horses?", E_USER_ERROR);

while ($line = fgets($handle)) {
	$tokens = preg_split('/\s+/', trim($line));

	while (count($tokens)) {
		$token = array_shift($tokens);

		if ($token == 'duck') {
			$duck++;
		} elseif ($token == 'horse') {
			$memory[$horse++] = $duck;
			$duck = 0;
		} elseif (is_numeric($token) && $tokens[0] == 'ducks') {
			array_shift($tokens);
			$duck += $token;
		} else {
			user_error("This is neither a horse, nor a duck: $token", E_USER_ERROR);
		}
	}

	$memory[$horse++] = $duck;
	$duck = 0;
}

fclose($handle);

// Uncomment to just dump memory & die
// print_r($memory); die;

// Now execute basic subleq

function read($ptr) {
	global $memory;

	switch (true) {
		case $ptr == 0:
		default:
			return 0;
		case array_key_exists($ptr, $memory):
			return $memory[$ptr];
	}
}

function write($ptr, $value) {
	global $memory;

	switch (true) {
		case $ptr == 0:
			echo chr(-$value);
			return 0;
		default:
			return $memory[$ptr] = $value;
	}
}

$ptr = 0;
while ($ptr >= 0) {
	// Get the op arguments

	$a = read($ptr);
	$b = read($ptr + 1);
	$c = read($ptr + 2);

	// Do the sub

	$res = write($b, read($b) - read($a));

	// Now the leq

	if ($res <= 0) $ptr = $c;
	else $ptr = $ptr + 3;
}
