<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    use HasFactory;

    protected $fillable = [
        'no_trx',
        'member_id',
        'loan_type_id',
        'loan_amount',
        'remaining_loan',
        'interest_rate',
        'loan_duration',
        'installment_amount',
        'due_date',
        'status',
    ];

    public function Member()
    {
        return $this->hasOne(Member::class, 'id', 'member_id');
    }
}
