<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    /** @use HasFactory<\Database\Factories\CustomerFactory> */
    use HasFactory;
    protected $fillable = [
        'name',
        'email',
        'type',
        'address',
        'city',
        'state',
        'postal_code',
        'active',
    ];
    public function invoices()
    {
        return $this->hasMany(Invoices::class);
    }
}

