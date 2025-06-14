<?php

namespace Core;

class DB
{
  private static ?\PDO $instance = null;

  public static function getConnection(): \PDO
  {
    if (self::$instance === null) {
      $config = require __DIR__ . '/../config/database.php';
      $dsn = "{$config['driver']}:host={$config['host']};port={$config['port']};dbname={$config['database']};
      charset={$config['charset']}";

      self::$instance = new \PDO($dsn, $config['username'], $config['password'], [
        \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
        \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
      ]);
    }

    return self::$instance;
  }
}
