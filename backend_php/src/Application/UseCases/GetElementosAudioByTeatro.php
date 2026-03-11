<?php

declare(strict_types=1);

namespace App\Application\UseCases;

use App\Domain\Ports\ElementoAudioRepositoryInterface;
use App\Domain\Models\ElementoAudio;

class GetElementosAudioByTeatro {
    private ElementoAudioRepositoryInterface $elementoAudioRepository;

    public function __construct(ElementoAudioRepositoryInterface $elementoAudioRepository) {
        $this->elementoAudioRepository = $elementoAudioRepository;
    }

    /**
     * Ejecuta el caso de uso y devuelve los elementos de audio asociados a un teatro.
     *
     * @param int $idTeatro El ID del teatro para el cual se desea obtener los elementos de audio.
     * @return ElementoAudio[]|null Un arreglo de objetos ElementoAudio o null si no se encuentra ningún elemento de audio.
     */
    public function execute(int $idTeatro): ?array
    {
        // Orquesta la llamada al puerto (repositorio) y aplica
        // reglas de aplicación si fuera necesario.
        $elementosAudio = $this->elementoAudioRepository->getElementosAudioByTeatro($idTeatro);

        // Aquí se podrían transformar entidades a DTOs, filtrar resultados,
        // o lanzar excepciones de aplicación si hay reglas que incumplen.
        return $elementosAudio;
    }
}