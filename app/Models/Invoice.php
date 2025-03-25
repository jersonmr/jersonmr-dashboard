<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    protected function casts()
    {
        return [
            'date' => 'date',
            'status' => \App\Enums\InvoiceStatusEnum::class,
            'currency' => \App\Enums\CurrencyEnum::class,
        ];
    }
}
