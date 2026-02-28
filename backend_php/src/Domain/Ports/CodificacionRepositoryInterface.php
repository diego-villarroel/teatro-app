<?php

declare(strict_types=1);

namespace App\Domain\Ports;

use App\Domain\Models\Codificacion;

interface CodificacionRepositoryInterface {
  /**
   * Obtiene una codificación por su ID.
   * @param int $id El ID de la codificación que se desea obtener.
   * @return Codificacion|null La codificación encontrada o null si no se encuentra.
   */
  public function getCodificacionById($id): ?Codificacion;

  /**
   * Agrega una nueva codificación al sistema.
   * @param Codificacion $codificacion El objeto Codificacion que se desea agregar.
   * @return void
   */
  public function addCodificacion(Codificacion $codificacion): void;

  /** CAPAZ NO VA
   * Actualiza la información de una codificación existente.
   * @param Codificacion $codificacion El objeto Codificacion con la información actualizada.
   * @return void
   */
  public function updateCodificacion(Codificacion $codificacion): void;

  /**
   * Elimina una codificación del sistema.
   * @param int $id El ID de la codificación que se desea eliminar.
   * @return void
   */
  public function deleteCodificacion($id): void;

  /**
   * Obtiene una lista de todas las codificaciones disponibles en el sistema.
   * @return Codificacion[] Un array de objetos Codificacion que representan todas las codificaciones disponibles.
   */

  public function getAllCodificaciones(): array;

  /**
   * Obtiene una lista de codificaciones asociadas a un teatro específico.
   * @param int $id_teatro El ID del teatro para el cual se desea obtener las codificaciones.
   * @return Codificacion[] Un array de objetos Codificacion que representan las codificaciones asociadas al teatro especificado.
   */
  public function getCodificacionesByTeatro($id_teatro): array;

  /**
   * Obtiene una lista de codificaciones asociadas a un teatro y a una sala especifica.
   * @param int $id_teatro El ID del teatro para el cual se desea obtener las codificaciones.
   * @param int $id_sala El ID de la sala para la cual se desea obtener las codificaciones.
   * @return Codificacion[]|null Un array de objetos Codificacion que representan las codificaciones asociadas al teatro y sala especificados, o null si no se encuentran.
   */
  public function getCodificacionesByTeatroAndSala($id_teatro, $id_sala): ?array;

  /**
   * Carga masiva de codificaciones asociadas a un teatro y a una sala especifica.
   * @param int $id_teatro El ID del teatro para el cual se desea cargar las codificaciones.
   * @param int $id_sala El ID de la sala para la cual se desea cargar las codificaciones.
   * @param Codificacion[] $codificaciones Un array de objetos Codificacion que se desean cargar.
   * @return void
   */
  public function bulkLoadCodificacionesByTeatroAndSala(int $id_teatro, int $id_sala, array $codificaciones): void;
}