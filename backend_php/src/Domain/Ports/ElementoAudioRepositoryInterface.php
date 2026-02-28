<?php

declare(strict_types=1);

namespace App\Domain\Ports;

use App\Domain\Models\ElementoAudio;

interface ElementoAudioRepositoryInterface {
  /**
   * Obtiene un elemento de audio por su ID.
   * @param int $id El ID del elemento de audio que se desea obtener.
   * @return ElementoAudio|null El elemento de audio encontrado o null si no se encuentra.
   */
  public function getElementoAudioById($id): ?ElementoAudio;

  /**
   * Agrega un nuevo elemento de audio al sistema.
   * @param ElementoAudio $elementoAudio El objeto ElementoAudio que se desea agregar.
   * @return void
   */
  public function addElementoAudio(ElementoAudio $elementoAudio): void;

  /** CAPAZ NO VA
   * Actualiza la información de un elemento de audio existente.
   * @param ElementoAudio $elementoAudio El objeto ElementoAudio con la información actualizada.
   * @return void
   */
  public function updateElementoAudio(ElementoAudio $elementoAudio): void;

  /**
   * Elimina un elemento de audio del sistema.
   * @param int $id El ID del elemento de audio que se desea eliminar.
   * @return void
   */
  public function deleteElementoAudio($id): void;
  
  /**
   * Obtiene una lista de todos los elementos de audio disponibles en el sistema.
   * @return ElementoAudio[] Un array de objetos ElementoAudio que representan todos los elementos de audio disponibles.
   */
  public function getAllElementosAudio(): array;

  /**
   * Obtiene una lista de elementos de audio asociados a un teatro específico.
   * @param int $id_teatro El ID del teatro para el cual se desea obtener los elementos de audio.
   * @return ElementoAudio[] Un array de objetos ElementoAudio que representan los elementos de audio asociados al teatro especificado.
   */
  public function getElementosAudioByTeatro($id_teatro): array;

  /**
   * Obtiene una lista de elementos de audios asociados a un teatro y a una sala especifica.
   * @param int $id_teatro El ID del teatro para el cual se desea obtener los elementos de audio.
   * @param int $id_sala El ID de la sala para la cual se desea obtener los elementos de audio.
   * @return ElementoAudio[]|null Un array de objetos ElementoAudio que representan los elementos de audio asociados al teatro y sala especificados, o null si no se encuentran.
   */
  public function getElementosAudioByTeatroAndSala($id_teatro, $id_sala): ?array;

  /**
   * Cambia el estado de un elemento de audio.
   * @param int $id El ID del elemento de audio cuyo estado se desea cambiar.
   * @param int $nuevoEstadoId El ID del nuevo estado que se desea establecer para el elemento de audio.
   * @return void
   */
  public function changeElementoAudioEstado(int $id, int $nuevoEstadoId): void;
}