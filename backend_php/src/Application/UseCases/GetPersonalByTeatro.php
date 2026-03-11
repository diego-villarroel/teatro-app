<?php

declare(strict_types=1);

namespace App\Application\UseCases;

use App\Domain\Ports\PersonalRepositoryInterface;
use App\Domain\Models\Personal;

class GetPersonalByTeatro {
    private PersonalRepositoryInterface $personalRepository;

    public function __construct(PersonalRepositoryInterface $personalRepository) {
        $this->personalRepository = $personalRepository;
    }

    /**
     * Ejecuta el caso de uso y devuelve el personal asociado a un teatro.
     *
     * @param int $idTeatro El ID del teatro para el cual se desea obtener el personal.
     * @return Personal[]|null Un arreglo de objetos Personal o null si no se encuentra ningún personal.
     */
    public function execute(int $idTeatro): ?array
    {
        // Orquesta la llamada al puerto (repositorio) y aplica
        // reglas de aplicación si fuera necesario.
        $personal = $this->personalRepository->getPersonalByTeatro($idTeatro);

        // Aquí se podrían transformar entidades a DTOs, filtrar resultados,
        // o lanzar excepciones de aplicación si hay reglas que incumplen.
        return $personal;
    }
}