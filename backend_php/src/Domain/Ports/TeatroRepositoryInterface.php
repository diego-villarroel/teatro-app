<?php

declare(strict_types=1);

namespace App\Domain\Ports;

use App\Domain\Models\Teatro;

interface TeatroRepositoryInterface {
  /**
   * Obtiene un teatro por su ID.
   * @param int $id El ID del teatro que se desea obtener.
   * @return Teatro|null El teatro encontrado o null si no se encuentra.
   */
  public function getTeatroById($id): ?Teatro;

  /**
   * Agrega un nuevo teatro al sistema.
   * @param Teatro $teatro El objeto Teatro que se desea agregar.
   * @return void
   */
  public function addTeatro(Teatro $teatro): void;

  /** CAPAZ NO VA
   * Actualiza la información de un teatro existente.
   * @param Teatro $teatro El objeto Teatro con la información actualizada.
   * @return void
   */
  public function updateTeatro(Teatro $teatro): void;

  /**
   * Obtiene una lista de todos los teatros disponibles en el sistema.
   * @return Teatro[] Un array de objetos Teatro que representan todos los teatros disponibles.
   */

  public function getAllTeatros(): array;
}