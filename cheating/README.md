# Horse/duck

If you're too weak to write horse/duck directly, there is an assembler and a C++(ish) compiler
written by other people that output subleq. sq_to_hd.php will convert that into horse/duck

Example:

    g++ thirdparty/sqasm.cpp -o sqasm
    cat helloworld.asq | ./sqasm | php ./sq_to_hd.php | php ../horseduck.php
