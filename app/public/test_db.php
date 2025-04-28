<?php
// Get environment variables or use defaults
$host = getenv('database.default.hostname') ?: 'db';
$user = getenv('database.default.username') ?: 'ci4_user';
$pass = getenv('database.default.password') ?: 'ci4_password';
$db   = getenv('database.default.database') ?: 'ci4';

try {
    $mysqli = new mysqli($host, $user, $pass, $db);
    echo "Connected successfully!";
    $mysqli->close();
} catch (mysqli_sql_exception $e) {
    echo "Connection failed: " . $e->getMessage();
    echo "<br>Using connection params:";
    echo "<br>Host: $host";
    echo "<br>User: $user";
    echo "<br>Database: $db";
}