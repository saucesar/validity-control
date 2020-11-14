<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['barcode', 'description'];

    public function toArray()
    {
        return [
            'barcode' => $this->barcode,
            'description' => $this->description,
        ];
    }
}
