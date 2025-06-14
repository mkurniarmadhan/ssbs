<?php

require __DIR__ . '/../vendor/autoload.php';

use Core\DB;

$pdo  = new PDO("mysql:host=localhost;port=3306;dbname=ssbs", "root", "rahasia");

$pdo->exec("TRUNCATE TABLE bookings");

$pdo->beginTransaction();

$stmt = $pdo->prepare(query: "INSERT INTO bookings (name, email, date) VALUES (?, ?,?)");


for ($i = 0; $i < 10000; $i++) {
  $name = "User_" . rand(1, 10000);
  $email = "user$i@test.com";
  $date =  date('Y-m-d H:i:s');
  $stmt->execute([$name, $email, $date]);

  if ($i % 1000 === 0) {
    echo "Inserted $i rows\n";
  }
}

$pdo->commit();
echo "Done.\n";
