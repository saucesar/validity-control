<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['barcode', 'description'];

    public function toArray($withshelflifes = true)
    {
        $array = [
            'id' => $this->id,
            'barcode' => $this->barcode,
            'description' => $this->description,
        ];
        
        $withshelflifes ? $array['shelflifes'] = $this->shelflifes->toArray() : '';

        return $array;
    }

    public function shelflifes()
    {
        return $this->hasMany(ShelfLife::class, 'product_id', 'id');
    }
}
