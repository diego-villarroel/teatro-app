<?php

declare(strict_types=1);

namespace App\Presentation\Controllers;

use App\Application\UseCases\GetAllTeatros;
use App\Domain\Models\Teatro;

class TeatrosController
{
    private GetAllTeatros $getAllTeatros;

    public function __construct(GetAllTeatros $getAllTeatros)
    {
        $this->getAllTeatros = $getAllTeatros;
    }

    /**
     * Maneja la petición GET /teatros
     *
     * @return void
     */
    public function index(): void
    {
        // ejecuta el caso de uso
        $teatros = $this->getAllTeatros->execute();

        // convierte a un arreglo de datos simples
        $payload = array_map(function (Teatro $t) {
            return [
                'id' => $t->getId(),
                'nombre' => $t->getNombre(),
            ];
        }, $teatros);

        header('Content-Type: application/json; charset=utf-8');
        echo json_encode(['data' => $payload]);
    }
}
