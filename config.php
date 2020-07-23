<?php
$database_config = (object) [
    'host'    => 'localhost',
    'user'    => 'root',
    'pass'    => '',
    'dbname'  => 'test'
];
define('SITE_URL', 'http://localhost/site/');

define('SITE_PATH', __DIR__ . DIRECTORY_SEPARATOR);
try {
    $pdo = new PDO("mysql:host={$database_config->host};dbname={$database_config->dbname}", $database_config->user, $database_config->pass);
    $pdo->exec('set names utf8');
} catch (Exception $e) {
    die("There is something wrong with connection, error: " . $e->getMessage());
}
$pdo ->query("CREATE TABLE IF NOT EXISTS users(
id INTEGER PRIMARY KEY AUTO_INCREMENT
 
  ); ");