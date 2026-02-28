<?php

declare(strict_types=1);

namespace App\Domain\Models;

class Horario
{
  private int $id;
  private string $nombre;
  private string $horaEntrada;
  private string $horaSalida;

  public function __construct(
    int $id,
    string $nombre,
    string $horaEntrada,
    string $horaSalida
  ) {
    $this->id = $id;
    $this->nombre = $nombre;
    $this->horaEntrada = $horaEntrada;
    $this->horaSalida = $horaSalida;
  }

  public function getId(): int
  {
    return $this->id;
  }

  public function getNombre(): string
  {
    return $this->nombre;
  }

  public function getHoraEntrada(): string
  {
    return $this->horaEntrada;
  }

  public function getHoraSalida(): string
  {
    return $this->horaSalida;
  }
}