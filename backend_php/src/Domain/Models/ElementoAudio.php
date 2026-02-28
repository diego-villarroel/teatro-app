<?php

declare(strict_types=1);

namespace App\Domain\Models;

class ElementoAudio {
  private int $id;
  private int $teatroId;
  private int $espacioId;
  private string $marca;
  private string $modelo;
  private int $estadoId;
  private DateTime $fechaCompra;
  private DateTime $fechaModificacion;

  public function __construct(int $id, string $nombre, int $teatroId, int $espacioId, string $marca, string $modelo, int $estadoId, DateTime $fechaCompra, DateTime $fechaModificacion) {
    $this->id = $id;
    $this->nombre = $nombre;
    $this->teatroId = $teatroId;
    $this->espacioId = $espacioId;
    $this->marca = $marca;
    $this->modelo = $modelo;
    $this->estadoId = $estadoId;
    $this->fechaCompra = $fechaCompra;
    $this->fechaModificacion = $fechaModificacion;
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

  public function getEspacioId(): int {
    return $this->espacioId;
  }

  public function getMarca(): string {
    return $this->marca;
  }

  public function getModelo(): string {
    return $this->modelo;
  }

  public function getEstadoId(): int {
    return $this->estadoId;
  }

  public function getFechaCompra(): DateTime {
    return $this->fechaCompra;
  }
  
  public function getFechaModificacion(): DateTime {
    return $this->fechaModificacion;
  }
}