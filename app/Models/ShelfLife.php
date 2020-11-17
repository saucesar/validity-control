<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

class ShelfLife extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['amount', 'date', 'product_id'];
    
    public function toArray()
    {
        $array = [
            'id' => $this->id,
            'amount' => $this->amount,
            'date' => Carbon::parse($this->date)->format('d-m-Y'),
            'product_id' => $this->product_id,
        ];

        return $array;
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id')->withTrashed();
    }
}