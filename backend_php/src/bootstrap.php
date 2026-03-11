<?php

declare(strict_types=1);

use App\Infrastructure\Persistence\PdoDatabaseAdapter;
use App\Infrastructure\Persistence\SQLiteAdapter;
use App\Infrastructure\Persistence\TeatroRepository;
use App\Infrastructure\Persistence\PersonalRepository;
use App\Application\UseCases\GetPersonalById;
use App\Application\UseCases\GetPersonalByTeatro;
use App\Application\UseCases\AuthenticatePersonal;
use App\Application\UseCases\GetAllTeatros;
use App\Presentation\Controllers\TeatrosController;
use App\Presentation\Controllers\PersonalController;

// autoload generated por composer
require __DIR__ . '/../vendor/autoload.php';

// cargar configuración
$config = require __DIR__ . '/../config/app.php';

// construir dependencias
$pdoAdapter    = new PdoDatabaseAdapter($config['dsn'], $config['user'], $config['pass']);
$sqlite        = new SQLiteAdapter($pdoAdapter);
// -- repositorios
$teatroRepo    = new TeatroRepository($sqlite);
$personalRepo   = new PersonalRepository($sqlite);
// -- use cases
$getAllTeatros = new GetAllTeatros($teatroRepo);
$getPersonalById = new GetPersonalById($personalRepo);
$getPersonalByTeatro = new GetPersonalByTeatro($personalRepo);
$authenticateUser = new AuthenticatePersonal($personalRepo);
// -- controladores
$teatroController    = new TeatrosController($getAllTeatros);
$personalController = new PersonalController($authenticateUser, $getPersonalById, $getPersonalByTeatro);


return [
    'teatros_controller' => $teatroController,
    'personal_controller' => $personalController,
];
