<?php

$memory = array();
$horse = 0;
$duck = 0;

$handle = fopen($argv[1], 'r');
while($line = fgets($handle)) {
	echo $line;
	$tokens = preg_split('/\s+/', trim($line));

	while(count($tokens)) {
		$token = array_shift($tokens);

		if ($token == 'duck') $duck++;
		elseif ($token == 'horse') { $memory[$horse++] = $duck; $duck = 0;}
		elseif (is_numeric($token) && $tokens[0] == 'ducks') {
			array_shift($tokens);
			$duck += $token;
		}
		else { echo "This is neither a horse, nor a duck: $token\n"; die; }
	}

	$memory[$horse++] = $duck;
	$duck = 0;
}

// print_r($memory); die;

$ptr = 0;

while ($ptr >= 0) {
  $a = $memory[$ptr];
  $b = $memory[$ptr+1];
  $c = $memory[$ptr+2];
  $res = 0;

  switch($b) {
	// Handle special memory locations
  	case 0:
  	  echo chr($memory[$a]);
  	  break;
	// First the sub
  	default:
  	  $res = $memory[$b] = $memory[$b] - $memory[$a];
  }
  
  // Now the leq
    
  if ($res <= 0) $ptr = $c;
  else $ptr = $ptr + 3;
}

