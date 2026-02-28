<?php

declare(strict_types=1);

namespace App\Infrastructure\Persistence;

use PDO;

interface DataBaseAdapterInterface {
  public function connect(): void;  
  public function getpdo(): PDO;
  public function disconnect(): void;
}