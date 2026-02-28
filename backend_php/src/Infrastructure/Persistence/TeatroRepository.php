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

  public function getTeatroById($id): ?Teatro {
    $sql = "SELECT * FROM teatros WHERE id = :id";
    $result = $this->dbAdapter->executeQuery($sql, ['id' => $id]);
    if (count($result) === 0) {
      return null;
    }
    $data = $result[0];
    return new Teatro($data['id'], $data['nombre'], $data['direccion']);
  }

  public function addTeatro(Teatro $teatro): void {
    $sql = "INSERT INTO teatros (nombre, direccion) VALUES (:nombre, :direccion)";
    $this->dbAdapter->executeNonQuery($sql, [
      'nombre' => $teatro->getNombre(),
      'direccion' => $teatro->getDireccion()
    ]);
  }

  public function updateTeatro(Teatro $teatro): void {
    $sql = "UPDATE teatros SET nombre = :nombre, direccion = :direccion WHERE id = :id";
    $this->dbAdapter->executeNonQuery($sql, [
      'id' => $teatro->getId(),
      'nombre' => $teatro->getNombre(),
      'direccion' => $teatro->getDireccion()
    ]);
  }

  public function getAllTeatros(): array {
    $sql = "SELECT * FROM teatros";
    $results = $this->dbAdapter->executeQuery($sql);
    return array_map(function ($data) {
      return new Teatro($data['id'], $data['nombre'], $data['direccion']);
    }, $results);
  }
}

