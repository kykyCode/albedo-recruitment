<?php

namespace App\DTOs;

class ApplicationData
{
    public function __construct(
        public string $first_name,
        public string $last_name,
        public string $phone_number,
        public string $email,
        public string $receipt_number,
        public string $purchase_date,
        public string $receipt_image_path,
        public bool $terms_accepted,
        public ?bool $marketing_consent = null,
    ) {}
}
