<?php

namespace App\Http\Controllers;

use App\DTOs\ApplicationData;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\UploadedFile;
use App\Contracts\IApplicationService;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreApplicationRequest;

class ApplicationController extends Controller
{
    /**
     * ApplicationController constructor.
     *
     * Injects the application service dependency to handle business logic related to applications.
     *
     * @param IApplicationService $applicationService
     */
    public function __construct(protected IApplicationService $applicationService) {}

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreApplicationRequest $request
     *     The validated HTTP request containing application details.
     * 
     * @return \Illuminate\Http\JsonResponse
     *     A JSON response indicating the status of the operation.
     */
    public function store(StoreApplicationRequest $request): JsonResponse
    {
        $validatedData = $request->validated();

        $receiptPath = $this->storeReceiptFile($request->file('receipt_image'));

        $applicationData = new ApplicationData(
            first_name: $validatedData['first_name'],
            last_name: $validatedData['last_name'],
            phone_number: $validatedData['phone_number'],
            email: $validatedData['email'],
            receipt_number: $validatedData['receipt_number'],
            purchase_date: $validatedData['purchase_date'],
            receipt_image_path: $receiptPath,
            terms_accepted: $validatedData['terms_accepted'],
            marketing_consent: $validatedData['marketing_consent'] ?? null,
        );

        $this->applicationService->createApplication($applicationData);

        return response()->json(['message' => 'Application processed successfully.'], 201);
    }

    /**
     * Store the receipt file and return its storage path.
     *
     * @param \Illuminate\Http\UploadedFile $file
     * @return string
     */
    private function storeReceiptFile(UploadedFile $file): string
    {
        $path = Storage::putFile('receipts', $file);

        if (!$path) {
            throw new \Exception('Failed to store the receipt image.');
        }

        return $path;
    }
    
}
