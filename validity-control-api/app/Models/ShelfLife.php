<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ShelfLife extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['amount', 'date', 'product_id'];

    public function toArray()
    {
        $array = [
            'amount' => $this->amount,
            'date' => $this->date,
            'product' => $this->product->toArray(false),
        ];

        return $array;
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id')->withTrashed();
    }
}
