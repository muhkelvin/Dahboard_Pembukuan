<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    use HasFactory;

    protected $fillable = ['description', 'amount', 'expense_date'];

    protected $casts = [
        'expense_date' => 'date',
        'amount' => 'decimal:2',
    ];


}
