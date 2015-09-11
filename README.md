horse/duck is an encoding of [subleq](https://esolangs.org/wiki/Subleq), a one-instruction 
computer. `horse` (or end of line) represents a byte separator. The number of `duck`s 
between  each horse is counted, and the count is the value of that byte.

(You can also cheat and write `X ducks` where X is an integer)

Example: php ./horseduck_interpreter.php horseduck_example.hd
