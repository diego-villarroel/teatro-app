<?php

declare(strict_types=1);

namespace App\Domain\Ports;

use App\Domain\Models\Personal;

interface PersonalRepositoryInterface {
  /**
   * Obtiene el personal de un teatro específico.
   * @param int $id_teatro El ID del teatro para el cual se desea obtener el personal.
   * @return Personal[]
   */
  public function getPeronalByTeatro($id_teatro): array;

  /**
   * Obtiene un personal por su ID.
   * @param int $id El ID del personal que se desea obtener.
   * @return Personal|null El personal encontrado o null si no se encuentra.
   */
  public function getPersonalById($id): ?Personal;

  /**
   * Agrega un nuevo personal al sistema.
   * @param Personal $personal El objeto Personal que se desea agregar.
   * @return void
   */
  public function addPersonal(Personal $personal): void;

  /** CAPAZ NO VA
   * Actualiza la información de un personal existente.
   * @param Personal $personal El objeto Personal con la información actualizada.
   * @return void
   */
  public function updatePersonal(Personal $personal): void;

  /**
   * Elimina un personal del sistema.
   * @param int $id El ID del personal que se desea eliminar.
   * @return void
   */
  public function deletePersonal($id): void;

  /**
   * Verifica las credenciales de un personal para autenticación.
   * @param string $nombre El nombre del personal.
   * @param string $password La contraseña del personal.
   * @return Personal|null El personal autenticado o null si las credenciales son incorrectas
   */
  public function authenticatePersonal(string $nombre, string $password): ?Personal;

  /**
   * Cambia la contraseña de un personal.
   * @param int $personalId El ID del personal cuya contraseña se desea cambiar.
   * @param string $nuevaPassword La nueva contraseña que se desea establecer.
   * @return void
   */
  public function changePersonalPassword(int $personalId, string $nuevaPassword): void;

  /**
   * Reasignar el personal a un nuevo teatro.
   * @param int $personalId El ID del personal a reasignar.
   * @param int $nuevoTeatroId El ID del nuevo teatro al que se asignará el personal.
   * @return void
   */
  public function reassignPersonalToTeatro(int $personalId, int $nuevoTeatroId): void;

}