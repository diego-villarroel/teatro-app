<?php

declare(strict_types=1);

namespace App\Infrastructure\Persistence;

class SQLiteAdapter {
  private PdoDatabaseAdapter $dbAdapter;

  public function __construct(PdoDatabaseAdapter $dbAdapter) {
    $this->dbAdapter = $dbAdapter;
  }

  // Aquí puedes agregar métodos comunes para interactuar con la base de datos SQLite
  public function executeQuery(string $sql, array $params = []): array {
    $this->dbAdapter->connect();
    $pdo = $this->dbAdapter->getpdo();
    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);
    return $stmt->fetchAll(\PDO::FETCH_ASSOC);
  }

  public function executeNonQuery(string $sql, array $params = []): void {
    $this->dbAdapter->connect();
    $pdo = $this->dbAdapter->getpdo();
    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);
  }

  public function disconnect(): void {
    $this->dbAdapter->disconnect();
  }
}