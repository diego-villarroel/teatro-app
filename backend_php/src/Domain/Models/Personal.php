<?php

declare(strict_types=1);

namespace App\Domain\Models;

use DateTime;

class Personal {
  private int $id;
  private string $password;
  private int $teatroId;
  private int $salaId;
  private string $nombre;
  private string $apellido;
  private int $horarioId;
  private int $cargoId;
  private int $estadoId;
  private DateTime $fechaIngreso;
  private DateTime $fechaModificacion;

  public function __construct (
    int $id,
    string $password,
    int $teatroId,
    int $salaId,
    string $nombre,
    string $apellido,
    int $horarioId,
    int $cargoId,
    int $estadoId,
    DateTime $fechaIngreso,
    DateTime $fechaModificacion
  )
  {
    $this->id = $id;
    $this->password = $password;
    $this->teatroId = $teatroId;
    $this->salaId = $salaId;
    $this->nombre = $nombre;
    $this->apellido = $apellido;
    $this->horarioId = $horarioId;
    $this->cargoId = $cargoId;
    $this->estadoId = $estadoId;
    $this->fechaIngreso = $fechaIngreso;
    $this->fechaModificacion = $fechaModificacion;
  }

  public function getId(): int {
    return $this->id;
  }

  public function getPassword(): string {
    return $this->password;
  }

  public function getTeatroId(): int {
    return $this->teatroId;
  }

  public function getSalaId(): int {
    return $this->salaId;
  }

  public function getNombre(): string {
    return $this->nombre;
  }

  public function getApellido(): string {
    return $this->apellido;
  }

  public function getHorarioId(): int {
    return $this->horarioId;
  }

  public function getCargoId(): int {
    return $this->cargoId;
  }

  public function getEstadoId(): int {
    return $this->estadoId;
  }

  public function getFechaIngreso(): DateTime {
    return $this->fechaIngreso;
  }

  public function getFechaModificacion(): DateTime {
    return $this->fechaModificacion;
  }
}