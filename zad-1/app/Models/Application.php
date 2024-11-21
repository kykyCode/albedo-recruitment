<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'phone_number',
        'email',
        'receipt_number',
        'purchase_date',
        'receipt_image_path',
        'terms_accepted',
        'marketing_consent',
    ];

    public function setPurchaseDateAttribute($value)
    {
        $this->attributes['purchase_date'] = \Carbon\Carbon::createFromFormat('d-m-Y', $value)->format('Y-m-d');
    }
}
