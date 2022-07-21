<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductDetails extends Model
{
    use HasFactory;
    protected $fillable = [
        'date',
        'billNo',
        'customerId',
        'productId',
        'rate',
        'qty',
        'discount',
        'totalAmount',
        'netAmount',
        'paidAmount',
        'discountTotal',
        'netTotal',
        'dueAmount',
        'status'
    ];
}
