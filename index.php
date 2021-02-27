<?php

require "exceptions/DatabaseConnectionException.php";
require "lib/functions.php";
require "lib/database.php";
require "lib/auth.php";

$config = include "config.php";

try {
    s = new Database(
        "mysql:host=".$config['DB_HOST'].";dbname={$config['DB_NAME']}",
        $config['DB_USER'],
        $config['DB_PASSWORD']
    );
} catch (DatabaseConnectionException $e) {
    die("<h1>Veritabanı Bağlantı Hatası!</h1>");
}

$auth = new Auth($database);

if (!$auth->check()) redirect("login.php");

$categories = $database->select('category', ['user_id' => $auth->check()]);
?>
<!doctype html>
<html>
<head>
    <title>Not Defterim - Kategoriler</title>
</head>
<body>
<?php if ($categories): ?>
<ul>
  <?php foreach ($categories as $key => $category): ?>
    <li><?=$category->name?></li>
  <?php endforeach; ?>
</ul>
<?php else: ?>
  <p> Kategori bulunamadı!.</p>
<?php endif; ?>
</body>
</html>
