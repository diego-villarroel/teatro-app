<?php

declare(strict_types=1);

namespace App\Domain\Models;

class Cargo
{
  private int $id;
  private string $nombre;

  public function __construct(int $id, string $nombre)
  {
    $this->id = $id;
    $this->nombre = $nombre;
  }

  public function getId(): int
  {
    return $this->id;
  }

  public function getNombre(): string
  {
    return $this->nombre;
  }
}