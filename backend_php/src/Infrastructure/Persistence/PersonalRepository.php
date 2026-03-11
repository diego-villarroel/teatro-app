<?php

declare(strict_types=1);

namespace App\Infrastructure\Persistence;

use App\Domain\Models\Personal;
use App\Domain\Ports\PersonalRepositoryInterface;
use App\Infrastructure\Persistence\SQLiteAdapter;

class PersonalRepository implements PersonalRepositoryInterface {
  private SQLiteAdapter $dbAdapter;

  public function __construct (SQLiteAdapter $dbAdapter) {
    $this->dbAdapter = $dbAdapter;
  }

  public function getPersonalByTeatro(int $idTeatro) : array {
    $sql = "SELECT * FROM Personal WHERE idTeatro = : idTeatro";
    $dbResp = $this->dbAdapter->executeQuery($sql, ["idTeatro" => $idTeatro]);
    if (count($dbResp) > 0) {
      $result = [];
      foreach ($dbResp as $pers) {
        $result[] = new Personal($pers['id'], $pers['password'], $pers['teatroId'], $pers['salaId'], $pers['nombre'], $pers['apellido'], $pers['horarioId'], $pers['cargoId'], $pers['estadoId'], $pers['fechaIngreso'], $pers['fechaModificacion']);
      }

      return $result;
    }
    return null;
  }

  public function getPersonalById(int $id) : ?Personal {
    $sql = "SELECT * FROM Personal WHERE id = :id";
    $dbResp = $this->dbAdapter->executeQuery($sql, ["id" => $id]);
    if (count($dbResp) > 0) {
      $pers = $dbResp[0];
      return new Personal($pers['id'], $pers['password'], $pers['teatroId'], $pers['salaId'], $pers['nombre'], $pers['apellido'], $pers['horarioId'], $pers['cargoId'], $pers['estadoId'], $pers['fechaIngreso'], $pers['fechaModificacion']);
    }
    return null;
  }

  public function addPersonal(Personal $personal) : void {
    $sql = "INSERT INTO Personal (password, teatroId, salaId, nombre, apellido, horarioId, cargoId, estadoId, fechaIngreso, fechaModificacion) VALUES (:password, :teatroId, :salaId, :nombre, :apellido, :horarioId, :cargoId, :estadoId, :fechaIngreso, :fechaModificacion)";
    $this->dbAdapter->executeNonQuery($sql, [
      "password" => $personal->getPassword(),
      "teatroId" => $personal->getTeatroId(),
      "salaId" => $personal->getSalaId(),
      "nombre" => $personal->getNombre(),
      "apellido" => $personal->getApellido(),
      "horarioId" => $personal->getHorarioId(),
      "cargoId" => $personal->getCargoId(),
      "estadoId" => $personal->getEstadoId(),
      "fechaIngreso" => $personal->getFechaIngreso()->format('Y-m-d H:i:s'),
      "fechaModificacion" => $personal->getFechaModificacion()->format('Y-m-d H:i:s')
    ]);
  }

  public function updatePersonal(Personal $personal) : void {
    $sql = "UPDATE Personal SET password = :password, teatroId = :teatroId, salaId = :salaId, nombre = :nombre, apellido = :apellido, horarioId = :horarioId, cargoId = :cargoId, estadoId = :estadoId, fechaIngreso = :fechaIngreso, fechaModificacion = :fechaModificacion WHERE id = :id";
    $this->dbAdapter->executeNonQuery($sql, [
      "id" => $personal->getId(),
      "password" => $personal->getPassword(),
      "teatroId" => $personal->getTeatroId(),
      "salaId" => $personal->getSalaId(),
      "nombre" => $personal->getNombre(),
      "apellido" => $personal->getApellido(),
      "horarioId" => $personal->getHorarioId(),
      "cargoId" => $personal->getCargoId(),
      "estadoId" => $personal->getEstadoId(),
      "fechaIngreso" => $personal->getFechaIngreso()->format('Y-m-d H:i:s'),
      "fechaModificacion" => $personal->getFechaModificacion()->format('Y-m-d H:i:s')
    ]);
  }

  public function deletePersonal(int $id) : void {
    $sql = "DELETE FROM Personal WHERE id = :id";
    $this->dbAdapter->executeNonQuery($sql, ["id" => $id]);
  }

  public function authenticatePersonal(string $nombre, string $password) : ?Personal {
    $sql = "SELECT * FROM Personal WHERE nombre = :nombre AND password = :password";
    $dbResp = $this->dbAdapter->executeQuery($sql, ["nombre" => $nombre, "password" => $password]);
    if (count($dbResp) > 0) {
      $pers = $dbResp[0];
      return new Personal($pers['id'], $pers['password'], $pers['teatroId'], $pers['salaId'], $pers['nombre'], $pers['apellido'], $pers['horarioId'], $pers['cargoId'], $pers['estadoId'], $pers['fechaIngreso'], $pers['fechaModificacion']);
    }
    return null;
  }

  public function isPersonalSessionActive(int $personalId) : bool {
    $sql = "SELECT sessionUpdate FROM Personal WHERE id = :id";
    $dbResp = $this->dbAdapter->executeQuery($sql, ["id" => $personalId]);
    if (count($dbResp) > 0) {
      $sessionUpdate = new DateTime($dbResp[0]['sessionUpdate']);
      $now = new DateTime();
      $interval = $now->getTimestamp() - $sessionUpdate->getTimestamp();
      return $interval < 3600; // Consideramos la sesión activa si ha habido actividad en la última hora
    }
    return false;
  }

  public function changePersonalPassword(int $personalId, string $nuevaPassword) : void {
    $sql = "UPDATE Personal SET password = :password WHERE id = :id";
    $this->dbAdapter->executeNonQuery($sql, ["id" => $personalId, "password" => $nuevaPassword]);
  }

  public function reasignarPersonal(Personal $personal, int $nuevoTeatroId, int $nuevaSalaId) : void {
    $personalId = $personal->getId();
    $secureData = [
      "id" => $personalId,
      "teatroId" => $personal->getTeatroId(),
      "salaId" => $personal->getSalaId()
    ];
    $sql = "UPDATE Personal SET teatroId = :teatroId, salaId = :salaId WHERE id = :id";
    $this->dbAdapter->executeNonQuery($sql, ["id" => $personalId, "teatroId" => $nuevoTeatroId, "salaId" => $nuevaSalaId]);
    // Chequea que la reasignación se haya realizado correctamente
    $updatedPersonal = $this->getPersonalById($personalId);
    if ($updatedPersonal === null || $updatedPersonal->getTeatroId() !== $nuevoTeatroId || $updatedPersonal->getSalaId() !== $nuevaSalaId) {
      // Si la reasignación no se realizó correctamente, loguea el error y lanza una excepción
      error_log("Failed to reassign personal with ID $personalId to new teatro ID $nuevoTeatroId and sala ID $nuevaSalaId");
      throw new Exception("Failed to reassign personal with ID $personalId to new teatro ID $nuevoTeatroId and sala ID $nuevaSalaId");

      // Luego se revierte la reasignación a los valores anteriores para mantener la integridad de los datos
      $sql = "UPDATE Personal SET teatroId = :teatroId, salaId = :salaId WHERE id = :id";
      $this->dbAdapter->executeNonQuery($sql, ["id" => $personalId, "teatroId" => $secureData['teatroId'], "salaId" => $secureData['salaId']]);
    }
  }
}