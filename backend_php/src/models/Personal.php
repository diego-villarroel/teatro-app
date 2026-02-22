<?php

declare(strict_types=1);

use DateTime;

class Personal {
  private int $id;
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
}