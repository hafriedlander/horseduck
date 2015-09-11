# Horse/duck

(C) 2015 Hamish Friedlander. He is sorry for what he has done.

## Syntax

horse/duck is an encoding of [subleq](https://esolangs.org/wiki/Subleq), a one-instruction
computer. `horse` (or end of line) represents a byte separator. The number of `duck`s
between  each horse is counted, and the count is the value of that byte.

(You can also cheat and write `X ducks` where X is an integer)

Example: 

    php ./horseduck.php example.hd

## Special memory locations

Because "-1 ducks" is ugly, the special memory location that outputs an
ascii value to the screen is "0". All programs should therefore start

    horse horse duck duck duck

to skip over the special memory locations

## For losers

See the cheat directory if you're not hard-core enough to write horse/duck directly