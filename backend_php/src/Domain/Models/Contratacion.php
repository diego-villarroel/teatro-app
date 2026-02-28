<?php

declare(strict_types=1);

namespace App\Domain\Models;

class Contratacion {
  private int $id;
  private string $nombre;
  private int $sueldo;
  private int $noCitado;

  public function __construct(
    int $id,
    string $nombre,
    int $sueldo,
    int $noCitado
  ) {
    $this->id = $id;
    $this->nombre = $nombre;
    $this->sueldo = $sueldo;
    $this->noCitado = $noCitado;
  }

  public function getId(): int {
    return $this->id;
  }

  public function getNombre(): string {
    return $this->nombre;
  }

  public function getSueldo(): int {
    return $this->sueldo;
  }

  public function getNoCitado(): int {
    return $this->noCitado;
  }
}