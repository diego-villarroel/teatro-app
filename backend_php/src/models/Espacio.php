<?php

declare(strict_types=1);

class Espacio {
  private int $id;
  private string $nombre;
  private int $teatroId;

  public function __construct(int $id, string $nombre, int $teatroId) {
    $this->id = $id;
    $this->nombre = $nombre;
    $this->teatroId = $teatroId;
  }

  public function getId(): int {
    return $this->id;
  }

  public function getNombre(): string {
    return $this->nombre;
  }

  public function getTeatroId(): int {
    return $this->teatroId;
  }
}