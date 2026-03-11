<?php

declare(strict_types=1);

namespace App\Infrastructure\Persistence;

use App\Domain\Models\Teatro;
use App\Domain\Ports\TeatroRepositoryInterface;
use App\Infrastructure\Persistence\SQLiteAdapter;

class TeatroRepository implements TeatroRepositoryInterface {
  private SQLiteAdapter $dbAdapter;

  public function __construct(SQLiteAdapter $dbAdapter) {
    $this->dbAdapter = $dbAdapter;
  }

  public function getTeatroById(int $id): ?Teatro {
    $sql = "SELECT id, nombre FROM teatros WHERE id = :id";
    $result = $this->dbAdapter->executeQuery($sql, ['id' => $id]);
    if (count($result) === 0) {
      return null;
    }
    $data = $result[0];
    return new Teatro((int)$data['id'], (string)$data['nombre']);
  }

  public function addTeatro(Teatro $teatro): void {
    $sql = "INSERT INTO teatros (nombre) VALUES (:nombre)";
    $this->dbAdapter->executeNonQuery($sql, [
      'nombre' => $teatro->getNombre(),
    ]);
  }

  public function updateTeatro(Teatro $teatro): void {
    $sql = "UPDATE teatros SET nombre = :nombre WHERE id = :id";
    $this->dbAdapter->executeNonQuery($sql, [
      'id' => $teatro->getId(),
      'nombre' => $teatro->getNombre(),
    ]);
  }

  public function getAllTeatros(): array {
    $sql = "SELECT id, nombre FROM teatros";
    $results = $this->dbAdapter->executeQuery($sql);
    return array_map(function ($data) {
      return new Teatro((int)$data['id'], (string)$data['nombre']);
    }, $results);
  }
}

