<?php

namespace App\Services;

use App\DTOs\ApplicationData;
use App\Contracts\IApplicationService;
use App\Models\Application;
use Mockery\CountValidator\Exact;

class ApplicationService implements IApplicationService
{
    /**
     * Creates a new application in the database.
     *
     * @param ApplicationData $applicationData
     * @return void
     */
    public function createApplication(ApplicationData $applicationData): void
    {
        try {
            Application::create([
                'first_name' => $applicationData->first_name,
                'last_name' => $applicationData->last_name,
                'phone_number' => $applicationData->phone_number,
                'email' => $applicationData->email,
                'receipt_number' => $applicationData->receipt_number,
                'purchase_date' => $applicationData->purchase_date,
                'receipt_image_path' => $applicationData->receipt_image_path,
                'terms_accepted' => $applicationData->terms_accepted,
                'marketing_consent' => $applicationData->marketing_consent,
            ]);
        } catch (\Throwable $e) {
            throw new \Exception('Failed to create application. Please try again later.');
        }
    }
}
