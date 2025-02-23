<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoices extends Model
{
    /** @use HasFactory<\Database\Factories\InvoicesFactory> */
    use HasFactory;
    protected $table = 'invoices';
    protected $fillable = [
        'customer_id',
        'title',
        'description',
        'amount',
        'status',
        'active',
        'billed_date',
        'paid_date',
    ];
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
