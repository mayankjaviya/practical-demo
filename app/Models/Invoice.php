<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = ['customer_name', 'invoice_date', 'due_date', 'total_amount', 'is_paid','reference_id'];

    public function invoiceItems(){

        return $this->hasMany(InvoiceItem::class);
    }
}
