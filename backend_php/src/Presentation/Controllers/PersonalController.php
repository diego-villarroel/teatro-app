<?php

declare(strict_types=1);

namespace App\Presentation\Controllers;

use App\Application\UseCases\AuthenticateUser;
use App\Application\UseCases\GetPersonalById;
use App\Aplication\UseCases\GetPersonalByTeatro;
use App\Domain\Models\Personal;

class PersonalController {
  private AuthenticateUser $authenticateUser;
  private GetPersonalById $getPersonalById;
  private GetPersonalByTeatro $getPersonalByTeatro;

  public function __contruct(
    AuthenticateUser $authenticateUser,
    GetPersonalById $getPersonalById,
    GetPersonalByTeatro $getPersonalByTeatro
  ) {
    $this->authenticateUser = $authenticateUser;
    $this->getPersonalById = $getPersonalById;
    $this->getPersonalByTeatro = $getPersonalByTeatro;
  }

  /**
   * Maneja la petición POST /personal/authenticate
   *
   * @return void
   */
  public function authenticate(): ?Personal{
    // Aquí se debería obtener el email y password del cuerpo de la petición.
    // Por simplicidad, vamos a usar valores hardcodeados.
    $user = 'admin';
    $password = '1234';

    return $this->authenticateUser->execute($user, $password);
  }

  /**
   * Maneja la petición GET /personal/{id}
   *
   * @param int $id
   * @return void
   */
  public function getById(int $id): ?Personal {
    return $this->getPersonalById->execute($id);
  }

  /**
   * Maneja la petición GET /personal/teatro/{teatroId}
   *
   * @param int $teatroId
   * @return Personal[]
   */
  public function getByTeatro(int $teatroId): array {
    return $this->getPersonalByTeatro->execute($teatroId);
  }
}