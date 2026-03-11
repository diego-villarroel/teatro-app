<?php

declare(strict_types=1);

namespace App\Application\UseCases;

use App\Domain\Ports\CodificacionRepositoryInterface;
use App\Domain\Models\Codificacion;

class GetCodificacionesByTeatro {
    private CodificacionRepositoryInterface $codificacionRepository;

    public function __construct(CodificacionRepositoryInterface $codificacionRepository) {
        $this->codificacionRepository = $codificacionRepository;
    }

    /**
     * Ejecuta el caso de uso y devuelve las codificaciones asociadas a un teatro.
     *
     * @param int $idTeatro El ID del teatro para el cual se desea obtener las codificaciones.
     * @return Codificacion[]|null Un arreglo de objetos Codificacion o null si no se encuentra ninguna codificación.
     */
    public function execute(int $idTeatro): ?array
    {
        // Orquesta la llamada al puerto (repositorio) y aplica
        // reglas de aplicación si fuera necesario.
        $codificaciones = $this->codificacionRepository->getCodificacionesByTeatro($idTeatro);

        // Aquí se podrían transformar entidades a DTOs, filtrar resultados,
        // o lanzar excepciones de aplicación si hay reglas que incumplen.
        return $codificaciones;
    }
}