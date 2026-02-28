<?php

declare(strict_types=1);

namespace App\Infrastructure\Persistence;

class PdoDatabaseAdapter implements DataBaseAdapterInterface {
  private ?\PDO $pdo = null;
  private string $dsn;
  private string $username;
  private string $password;

  public function __construct(string $dsn, string $username, string $password) {
    $this->dsn = $dsn;
    $this->username = $username;
    $this->password = $password;
  }

  public function connect(): void {
    if ($this->pdo === null) {
      try {
        $this->pdo = new \PDO($this->dsn, $this->username, $this->password);
        $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
      } catch (\PDOException $e) {
        throw new \RuntimeException('Failed to connect to the database: ' . $e->getMessage());
      }
    }
  }

  public function getpdo(): \PDO {
    if ($this->pdo === null) {
      throw new \RuntimeException('Database connection is not established.');
    }
    return $this->pdo;
  }

  public function disconnect(): void {
        // al anular la referencia el destructor de PDO cierra la conexión
        $this->pdo = null;
  }
}