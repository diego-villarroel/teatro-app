<?php

declare(strict_types=1);

namespace App\Application\UseCases;

use App\Domain\Ports\TeatroRepositoryInterface;
use App\Domain\Models\Teatro;

class GetAllTeatros
{
    private TeatroRepositoryInterface $teatroRepository;

    public function __construct(TeatroRepositoryInterface $teatroRepository)
    {
        $this->teatroRepository = $teatroRepository;
    }

    /**
     * Ejecuta el caso de uso y devuelve todos los teatros.
     *
     * @return Teatro[]
     */
    public function execute(): array
    {
        // Orquesta la llamada al puerto (repositorio) y aplica
        // reglas de aplicación si fuera necesario.
        $teatros = $this->teatroRepository->getAllTeatros();

        // Aquí se podrían transformar entidades a DTOs, filtrar resultados,
        // o lanzar excepciones de aplicación si hay reglas que incumplen.
        return $teatros;
    }
}
