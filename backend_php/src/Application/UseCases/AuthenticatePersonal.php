<?php

declare(strict_types=1);

namespace App\Application\UseCases;

use App\Domain\Ports\PersonalRepositoryInterface;
use App\Domain\Models\Personal;

class AuthenticatePersonal {
  private PersonalRepositoryInterface $personalRepository;

  public function __construct(PersonalRepositoryInterface $personalRepository) {
    $this->personalRepository = $personalRepository;
  }

  /**
   * Ejecuta el caso de uso de autenticación de personal.
   *
   * @param string $email El correo electrónico del personal a autenticar.
   * @param string $password La contraseña del personal a autenticar.
   * @return Personal|null El objeto Personal si la autenticación es exitosa, o null si falla.
   */

  public function execute(string $email, string $password): ?Personal {
    // Orquesta la llamada al puerto (repositorio) para obtener el personal por email.
    $personal = $this->personalRepository->getPersonalByEmail($email);

    // Verifica si se encontró el personal y si la contraseña es correcta.
    if ($personal !== null && password_verify($password, $personal->getPasswordHash())) {
      // La autenticación es exitosa, devuelve el objeto Personal.
      return $personal;
    }

    // La autenticación falla, devuelve null.
    return null;
  }
}