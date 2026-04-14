<?php
if ($argc < 2) {
    fwrite(STDERR, "Uso: php tools/hash.php <password>\n");
    exit(1);
}

echo password_hash($argv[1], PASSWORD_DEFAULT);

