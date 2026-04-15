<?php
echo "Password is valid: " . (password_verify('password', '$2y$10$K1gu.j4rG7/C4MCpGo4a.OM18zTrXmsifsi/Vup6jvOyrBVtWB5Ri') ? "YES" : "NO") . "\n";
?>
