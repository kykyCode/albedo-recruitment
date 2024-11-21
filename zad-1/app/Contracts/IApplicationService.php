<?php

namespace App\Contracts;

use App\DTOs\ApplicationData;

interface IApplicationService
{
    public function createApplication(ApplicationData $applicationData): void;
}
