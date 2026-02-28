<?php

declare(strict_types=1);

namespace App\Domain\Ports;

use DateTime;
use Time;

class Codificacion {
  private int $id;
  private string $nombre;
  private int $salaId;
  private int $teatroId;
  private DateTime $fecha;
  private Time $horaInicio;
  private Time $horaFin;
  private string $descripcion;

  public function __construct(
    int $id,
    string $nombre,
    int $salaId,
    int $teatroId,
    DateTime $fecha,
    Time $horaInicio,
    Time $horaFin,
    string $descripcion
  ) {
    $this->id = $id;
    $this->nombre = $nombre;
    $this->salaId = $salaId;
    $this->teatroId = $teatroId;
    $this->fecha = $fecha;
    $this->horaInicio = $horaInicio;
    $this->horaFin = $horaFin;
    $this->descripcion = $descripcion;
  }

  public function getId(): int {
    return $this->id;
  }

  public function getNombre(): string {
    return $this->nombre;
  }

  public function getSalaId(): int {
    return $this->salaId;
  }

  public function getTeatroId(): int {
    return $this->teatroId;
  }

  public function getFecha(): DateTime {
    return $this->fecha;
  }

  public function getHoraInicio(): Time {
    return $this->horaInicio;
  }

  public function getHoraFin(): Time {
    return $this->horaFin;
  }

  public function getDescripcion(): string {
    return $this->descripcion;
  }
}