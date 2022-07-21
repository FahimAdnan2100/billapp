<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BillInfo extends Model
{
    use HasFactory;
    protected $fillable = [
        
        'billNo',
        
        'paidAmount',
        'discountTotal',
        'netTotal',
        'dueAmount',
        
    ];
}
