<?php
// Supabase PostgreSQL Connection
$host = "db.rcoegkyqevfouvyrxfgp.supabase.co";
$port = "5432";
$dbname = "postgres";
$username = "postgres";
$password = "OrganizadorPers2026!";

try {
    $db = new PDO(
        "pgsql:host=$host;port=$port;dbname=$dbname;sslmode=require",
        $username,
        $password
    );
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}
?>
