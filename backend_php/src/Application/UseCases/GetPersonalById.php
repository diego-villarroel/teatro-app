<?php

declare(strict_types=1);

namespace App\Application\UseCases;

use App\Domain\Models\Personal;
use App\Domain\Ports\PersonalRepositoryInterface;

class GetPersonalById {
  private PersonalRepositoryInterface $personalRepo;

  public function __construct(PersonalRepositoryInterface $personalRepo) {
    $this->personalRepo = $personalRepo;
  }

  public function execute(int $id) : ?Personal {
    return $this->personalRepo->getPersonalById($id);
  }
}