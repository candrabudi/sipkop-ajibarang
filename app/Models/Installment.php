<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Installment extends Model
{
    use HasFactory;
    protected $fillable = [
        'no_installment',
        'loan_id',
        'installment_number',
        'installment_amount',
        'fine',
        'remaining_loan',
        'installment_date',
    ];
}
