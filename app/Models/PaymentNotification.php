<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PaymentNotification extends Model
{
    use HasFactory;

    protected $table = 'payment_notifications';

    const UPDATED_AT = null;

    protected $fillable = [
        'transaction_id',
        'transaction_status',
        'fraud_status',
        'notification_data',
        'processed_at',
    ];

    protected function casts(): array
    {
        return [
            'notification_data' => 'array',
            'processed_at' => 'datetime',
        ];
    }
}