<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;

    protected $fillable = ['product_id', 'name', 'quantity', 'total_price', 'purchase_date', 'payment_status'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function revenue()
    {
        return $this->hasOne(Revenue::class);
    }
}
